<?php

namespace App\Controllers;

// use App\Models\EleUserModel;
use App\Models\UserModel;
use App\Models\WarehouseModel;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Models\CustomerInventoryModel;
use App\Models\BarcodeModel;
// use App\Models\CustomerInventoryModel;
// use App\Models\BarcodeModel;
use App\Models\CustomerInventoryChildBarcodeModel;
use App\Models\PineInfoLeadModel;
use Config\Database;

// use Picqer\Barcode\BarcodeGeneratorPNG;


class Home extends BaseController
{

    public function index()


    {

        $model = new CustomerInventoryChildBarcodeModel();

        $today = date('Y-m-d');

        // Count how many barcodes were created today with status 'in'
        $inCount = $model
            ->where('item_status', 'in')
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        // Count how many barcodes were updated today with status 'out'
        $outCount = $model
            ->where('item_status', 'out')
            ->where('DATE(updated_at)', $today)
            ->countAllResults();

        $data = [];
        $warehouseModel = new WarehouseModel();
        $cards = $warehouseModel->findAll();

        // Add this block to count total leads
        $db = \Config\Database::connect();
        $builder = $db->table('pine_upload_inventory'); // use your actual leads table
        $totalLeads = $builder->countAll();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/index', [
                'inCount'  => $inCount,
                'outCount' => $outCount,
                // 'cards' => $cards,
                'totalLeads' => $totalLeads
            ])
            . view('templates/htmlclose');
    }




    public function login()
    {

        return view('Home/login');
    }


    public function logout()
    {
        session()->destroy(); // Destroy all session data
        return redirect()->to('/'); // Redirect to login or home page
    }

    public function fetchLeads($page = 1)
    {
        $model = new \App\Models\PineInfoLeadModel();

        // Get filters
        $globalSearch = $this->request->getGet('globalSearch');
        $sortBy       = $this->request->getGet('sortBy');
        $fromDate     = $this->request->getGet('fromDate');
        $toDate       = $this->request->getGet('toDate');
        $tableSearch  = $this->request->getGet('tableSearch');
        $perPage      = $this->request->getGet('showEntries') ?? 10;
        $offset       = ($page - 1) * $perPage;

        $userRole = session()->get('user_role');
        $assignedLocation = session()->get('assign_location');

        // Base query
        $query = $model->where('spanco', 'order');

        // Role-based filter
        if ($userRole === 'manager') {
            $query = $query->where('moving_to', $assignedLocation);
        }

        // Global search
        if (!empty($globalSearch)) {
            $query->groupStart()
                ->like('customer_name', $globalSearch)
                ->orLike('customer_mobile', $globalSearch)
                ->orLike('id', $globalSearch)
                ->groupEnd();
        }

        // Date filter
        if (!empty($fromDate) && !empty($toDate)) {
            $query->where('DATE(created_at) >=', $fromDate)
                ->where('DATE(created_at) <=', $toDate);
        }

        // Quick sort filters
        if (!empty($sortBy)) {
            if ($sortBy === 'Today') {
                $query->where('DATE(created_at)', date('Y-m-d'));
            } elseif ($sortBy === 'Yesterday') {
                $query->where('DATE(created_at)', date('Y-m-d', strtotime('-1 day')));
            } elseif ($sortBy === 'Tomorrow') {
                $query->where('DATE(created_at)', date('Y-m-d', strtotime('+1 day')));
            } elseif ($sortBy === 'Next 7 Days') {
                $query->where('DATE(created_at) BETWEEN "' . date('Y-m-d') . '" AND "' . date('Y-m-d', strtotime('+7 days')) . '"');
            }
        }

        // Table-specific search
        if (!empty($tableSearch)) {
            $query->like('customer_name', $tableSearch);
        }

        // Total count (important to call before findAll)
        $totalLeads = $query->countAllResults(false);

        // Final result
        $leads = $query->orderBy('id', 'asc')->findAll($perPage, $offset);

        return $this->response->setJSON([
            'leads' => $leads,
            'totalLeads' => $totalLeads,
            'totalPages' => ceil($totalLeads / $perPage)
        ]);
    }

    // public function viewInventory($leadId)
    // {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('customer_inventory');
    //     $builder->where('upload_inventory_id', $leadId);
    //     $query = $builder->get();
    //     $inventory = $query->getResult();

    //     return view('templates/header')
    //         . view('templates/sidebar')
    //         . view('Home/admin_cutomer_inventory', ['inventory' => $inventory, 'leadId' => $leadId])
    //         . view('templates/htmlclose');
    // }


    public function viewInventory($leadId)
    {
        $db = Database::connect();
        $builder = $db->table('customer_inventory');
        $builder->where('upload_inventory_id', $leadId);
        $query = $builder->get();
        $inventory = $query->getResult();

        // Add out_count to each inventory item
        foreach ($inventory as &$item) {
            $outCountBuilder = $db->table('customer_inventory_child_barcodes');
            $outCount = $outCountBuilder
                ->where('inventory_id', $item->id)
                ->where('item_status', 'out')
                ->countAllResults();

            $item->out_count = $outCount;
        }
        foreach ($inventory as &$item) {
            $outCountBuilder = $db->table('customer_inventory_child_barcodes');
            $inCount = $outCountBuilder
                ->where('inventory_id', $item->id)
                ->where('item_status', 'in')
                ->countAllResults();

            $item->in_count = $inCount;
        }

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/admin_cutomer_inventory', [
                'inventory' => $inventory,
                'leadId' => $leadId
            ])
            . view('templates/htmlclose');
    }

    public function addInventory()
    {
        $inventoryModel   = new CustomerInventoryModel();
        $barcodeModel     = new BarcodeModel();
        $childBarcodeModel = new CustomerInventoryChildBarcodeModel();

        $uploadInventoryId = $this->request->getPost('upload_inventory_id');
        $itemName          = $this->request->getPost('item_name');
        $quantity          = (int)$this->request->getPost('quantity');

        $customerId        = $this->request->getPost('customer_id');
        $customerName      = $this->request->getPost('customer_name');
        $contactNumber     = $this->request->getPost('contact_number');

        // Step 1: Insert into customer_inventory
        $inventoryData = [
            'upload_inventory_id' => $uploadInventoryId,
            'item_name'           => $itemName,
            'quantity'            => $quantity,
        ];
        $inventoryModel->insert($inventoryData);
        $inventoryId = $inventoryModel->getInsertID();

        // Step 2: Generate parent barcode value
        $parentBarcodeValue = 'PNV-' . str_pad($inventoryId, 4, '0', STR_PAD_LEFT);

        // Step 3: Generate parent barcode image
        $barcodeDir = FCPATH . '/barcodes/';
        if (!is_dir($barcodeDir)) {
            mkdir($barcodeDir, 0777, true);
        }

        $generator = new BarcodeGeneratorPNG();
        $barcodeData = $generator->getBarcode($parentBarcodeValue, $generator::TYPE_CODE_128);
        $parentBarcodeFile = $parentBarcodeValue . '.png';
        $parentBarcodePath = $barcodeDir . $parentBarcodeFile;
        // file_put_contents($parentBarcodePath, $barcodeData);





        // Create image from raw barcode data
        $barcodeGD = imagecreatefromstring($barcodeData);

        // Create a canvas with space for barcode + text
        $finalWidth = 192;
        $finalHeight = 96;
        $fontSize = 2;
        $textHeight = imagefontheight($fontSize);
        $barcodeHeight = $finalHeight - $textHeight;

        $canvas = imagecreatetruecolor($finalWidth, $finalHeight);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        $black = imagecolorallocate($canvas, 0, 0, 0);
        imagefill($canvas, 0, 0, $white);

        // Copy barcode image into canvas
        imagecopyresampled(
            $canvas,
            $barcodeGD,
            0,
            0,
            0,
            0,
            $finalWidth,
            $barcodeHeight,
            imagesx($barcodeGD),
            imagesy($barcodeGD)
        );

        // Centered barcode value text below the barcode
        $textWidth = imagefontwidth($fontSize) * strlen($parentBarcodeValue);
        $textX = ($finalWidth - $textWidth) / 2;
        $textY = $barcodeHeight + 1;
        imagestring($canvas, $fontSize, $textX, $textY, $parentBarcodeValue, $black);

        // Save final image
        imagepng($canvas, $parentBarcodePath);
        imagedestroy($barcodeGD);
        imagedestroy($canvas);







        // Step 4: Insert parent barcode
        $barcodeModel->insert([
            'rack_product_id'   => $inventoryId,
            'barcode_value'     => $parentBarcodeValue,
            'qr_image_path'     => '/barcodes/' . $parentBarcodeFile,
            'generated_by'      => session()->get('user_id') ?? 0,
            'customer_id'       => $customerId,
            'customer_name'     => $customerName,
            'customer_contact'  => $contactNumber,
        ]);

        // Step 5: Insert child barcodes based on quantity
        for ($i = 1; $i <= $quantity; $i++) {
            $childBarcodeValue = $parentBarcodeValue . '-' . $i;
            $childBarcodeFile = $childBarcodeValue . '.png';
            $childBarcodePath = $barcodeDir . $childBarcodeFile;

            // Generate barcode data
            $childData = $generator->getBarcode($childBarcodeValue, $generator::TYPE_CODE_128);

            // Create GD image from barcode
            $barcodeGD = imagecreatefromstring($childData);

            // Final canvas with space for barcode + text
            $finalWidth = 192;
            $finalHeight = 96;
            $fontSize = 2;
            $textHeight = imagefontheight($fontSize);
            $barcodeHeight = $finalHeight - $textHeight;

            $canvas = imagecreatetruecolor($finalWidth, $finalHeight);
            $white = imagecolorallocate($canvas, 255, 255, 255);
            $black = imagecolorallocate($canvas, 0, 0, 0);
            imagefill($canvas, 0, 0, $white);

            // Copy barcode image to canvas
            imagecopyresampled(
                $canvas,
                $barcodeGD,
                0,
                0,
                0,
                0,
                $finalWidth,
                $barcodeHeight,
                imagesx($barcodeGD),
                imagesy($barcodeGD)
            );

            // Draw barcode value text below the barcode (centered)
            $textWidth = imagefontwidth($fontSize) * strlen($childBarcodeValue);
            $textX = ($finalWidth - $textWidth) / 2;
            $textY = $barcodeHeight + 1;
            imagestring($canvas, $fontSize, $textX, $textY, $childBarcodeValue, $black);

            // Save final image
            imagepng($canvas, $childBarcodePath);
            imagedestroy($barcodeGD);
            imagedestroy($canvas);

            // Save to DB
            $childBarcodeModel->insert([
                'inventory_id'         => $inventoryId,
                'child_barcode_value'  => $childBarcodeValue,
                'serial_number'        => $i,
                'qr_image_path'        => '/barcodes/' . $childBarcodeFile,
            ]);
        }


        return redirect()->back()->with('success', 'Inventory and barcodes created successfully.');
    }




    // public function updateInventory($id)
    // {
    //     $model = new \App\Models\CustomerInventoryModel();

    //     $data = [
    //         'item_name'   => $this->request->getPost('item_name'),
    //         'quantity'    => $this->request->getPost('quantity'),
    //         // 'assemble'    => $this->request->getPost('assemble'),
    //         // 'crating'     => $this->request->getPost('crating'),
    //         // 'dismounting' => $this->request->getPost('dismounting'),
    //     ];

    //     if ($model->update($id, $data)) {
    //         return redirect()->back()->with('success', 'Inventory updated successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to update inventory.');
    //     }
    // }



    public function deleteInventory($id)
    {
        $db = \Config\Database::connect();
        $db->table('customer_inventory')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Inventory deleted successfully.');
    }


    public function UserDeatails()
    {


        return view('templates/sidebar');
        // return view('Home/home');
    }

    // Additional views
    public function table()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/table') . view('templates/htmlclose');
    }
    public function customers()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/customers') . view('templates/htmlclose');
    }
    public function employee()
    {

        return view('templates/header') . view('templates/sidebar') . view('Home/employee') . view('templates/htmlclose');
    }

    public function register()
    {
        $warehouseModel = new warehouseModel();

        $data['warehouses'] = $warehouseModel->findAll();

        // return view('Home/register', $data);
        return view('templates/header') . view('templates/sidebar') . view('Home/register', $data) . view('templates/htmlclose');
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        $request = service('request');

        $rules = [
            'name'            => 'required|min_length[3]',
            'email'           => 'required|valid_email|is_unique[info_users.email]',
            'phone_number'    => 'required|numeric|exact_length[10]',
            'password'        => 'required',
            'assign_location' => 'required',
            'user_role'       => 'required|in_list[admin,manager,telecaller]'
        ];

        $messages = [
            'email' => ['is_unique' => 'This email is already registered.'],
            'user_role' => ['in_list' => 'Please select a valid role.']
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        $model = new UserModel();

        $data = [
            'name'            => $request->getPost('name'),
            'email'           => $request->getPost('email'),
            'phone_number'    => $request->getPost('phone_number'),
            'password'        => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'assign_location' => $request->getPost('assign_location'),
            'user_role'       => $request->getPost('user_role'),
            'address'         => '', // default empty if not present in form
        ];

        $model->insert($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User registered successfully!'
        ]);
    }
    public function upload_inventory()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/upload_inventory') . view('templates/htmlclose');
    }


    // public function inventory_report()
    // {
    //     $customerId = session()->get('customer_id');

    //     if (!$customerId) {
    //         return redirect()->to('/cus_login')->with('error', 'Please login first.');
    //     }

    //     $inventoryModel = new \App\Models\CustomerInventoryModel();

    //     $data['inventories'] = $inventoryModel->where('upload_inventory_id', $customerId)->findAll();

    //     return view('templates/header') . view('templates/sidebar') . view('Home/inventory_report', $data) . view('templates/htmlclose');
    // }

    public function inventory_report($id)
    {
        // Load models
        $inventoryModel       = new \App\Models\CustomerInventoryModel();
        $childBarcodeModel    = new \App\Models\CustomerInventoryChildBarcodeModel();

        // Fetch parent inventory item
        $parentInventory = $inventoryModel->find($id);

        if (!$parentInventory) {
            return redirect()->to('/dashboard')->with('error', 'Inventory not found.');
        }

        // Fetch all child barcodes for this inventory item 
        $childBarcodes = $childBarcodeModel->where('inventory_id', $id)->findAll();

        // Pass data to view
        $data = [
            'inventory'      => $parentInventory,
            'childBarcodes'  => $childBarcodes,
        ];

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/inventory_report', $data)
            . view('templates/htmlclose');
    }





    public function getWarehouses()
    {
        $warehouseModel = new WarehouseModel();
        return $this->response->setJSON($warehouseModel->findAll());
    }

    public function getInventorys($leadId)
    {
        $leadModel = new \App\Models\PineInfoLeadModel();
        $inventoryModel = new \App\Models\CustomerInventoryModel();

        // Check if lead exists
        $lead = $leadModel->find($leadId);
        if (!$lead) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Lead not found'
            ]);
        }

        // Fetch related inventory
        $inventory = $inventoryModel
            ->where('upload_inventory_id', $leadId)
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'inventory' => $inventory
        ]);
    }


    public function getOrderLeads()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/mangerlead') . view('templates/htmlclose');
    }

    public function fetchOrderLeads()
    {
        $session = session();
        $userId = $session->get('user_id');

        $db = \Config\Database::connect();
        $builder = $db->table('pine_upload_inventory p');
        $builder->select('p.id, p.customer_name, p.customer_mobile, p.city, p.state, p.spanco, p.created_at');
        $builder->join('info_users u', 'p.city = u.assign_location OR p.state = u.assign_location');
        $builder->where('p.spanco', 'Order');
        $builder->where('u.user_id', $userId);
        $builder->where('u.user_role', 'manager');
        $builder->where('u.status', 'active');

        $query = $builder->get();
        return $this->response->setJSON($query->getResult());
    }




    public function dashboard()
    {
        $model = new CustomerInventoryChildBarcodeModel();

        $today = date('Y-m-d');

        // Count how many barcodes were created today with status 'in'
        $inCount = $model
            ->where('item_status', 'in')
            ->where('DATE(created_at)', $today)
            ->countAllResults();

        // Count how many barcodes were updated today with status 'out'
        $outCount = $model
            ->where('item_status', 'out')
            ->where('DATE(updated_at)', $today)
            ->countAllResults();

        $data = [
            'inCount'  => $inCount,
            'outCount' => $outCount,
        ];

        return view('dashboard/index', $data);
    }
}
