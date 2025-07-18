<?php

namespace App\Controllers;

// use App\Models\EleUserModel;
use App\Models\UserModel;
use App\Models\WarehouseModel;

class Home extends BaseController
{

    public function index()
    {
        $warehouseModel = new WarehouseModel();
        $cards = $warehouseModel->findAll();

        // Add this block to count total leads
        $db = \Config\Database::connect();
        $builder = $db->table('pine_upload_inventory'); // use your actual leads table
        $totalLeads = $builder->countAll();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/index', [
                'cards' => $cards,
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
        $leads = $query->orderBy('created_at', 'desc')->findAll($perPage, $offset);

        return $this->response->setJSON([
            'leads' => $leads,
            'totalLeads' => $totalLeads,
            'totalPages' => ceil($totalLeads / $perPage)
        ]);
    }


    public function viewInventory($leadId)
    {
        $db = \Config\Database::connect();

        // Get inventory matching this upload_inventory_id (lead ID)
        $builder = $db->table('customer_inventory');
        $builder->where('upload_inventory_id', $leadId);
        $query = $builder->get();

        $inventory = $query->getResult();

        return view('templates/header') . view('templates/sidebar') . view('Home/admin_cutomer_inventory', ['inventory' => $inventory, 'leadId' => $leadId]) . view('templates/htmlclose');
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


    public function inventory_report()
    {
        $customerId = session()->get('customer_id');

        if (!$customerId) {
            return redirect()->to('/cus_login')->with('error', 'Please login first.');
        }

        $inventoryModel = new \App\Models\CustomerInventoryModel();

        $data['inventories'] = $inventoryModel->where('upload_inventory_id', $customerId)->findAll();

        return view('templates/header') . view('templates/sidebar') . view('Home/inventory_report', $data) . view('templates/htmlclose');
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

    // public function customerforadmin
}
