<?php

namespace App\Controllers;

use App\Models\CustomerInventoryModel;
use App\Models\CustomerInventoryChildBarcodeModel;
use App\Models\BarcodeModel;
use Picqer\Barcode\BarcodeGeneratorPNG;

class customer_inventory extends BaseController
{
    public function list()
    {
        $session = session();
        $userRole = $session->get('user_role');
        $userId   = $session->get('user_id');
        $assignLocation = $session->get('assign_location'); // for managers

        $db = \Config\Database::connect();

        if ($userRole === 'admin') {
            // Admin sees all
            $query = $db->table('customer_inventory ci')
                ->select('ci.*, pb.barcode_value as barcode_value, pb.qr_image_path')
                ->join('pine_store_warehouse_barcodes pb', 'pb.rack_product_id = ci.id', 'left')
                ->get();
        } elseif ($userRole === 'manager') {
            // Manager sees only assigned customers
            $assignedIds = explode(',', $assignLocation); // If multiple assigned IDs
            $query = $db->table('customer_inventory ci')
                ->select('ci.*, pb.barcode_value as barcode_value, pb.qr_image_path')
                ->join('pine_store_warehouse_barcodes pb', 'pb.rack_product_id = ci.id', 'left')
                ->whereIn('ci.upload_inventory_id', $assignedIds)
                ->get();
        } elseif ($userRole === 'customer') {
            // Customer sees own inventory
            $query = $db->table('customer_inventory ci')
                ->select('ci.*, pb.barcode_value as barcode_value, pb.qr_image_path')
                ->join('pine_store_warehouse_barcodes pb', 'pb.rack_product_id = ci.id', 'left')
                ->where('ci.upload_inventory_id', $userId)
                ->get();
        } else {
            return redirect()->to('/login');
        }

        $data['inventories'] = $query->getResultArray();
        return view('Home/customers', $data);
    }






    public function generateBarcode()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $data = $this->request->getJSON();
        $itemId = $data->item_id ?? null;

        if (!$itemId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item ID missing']);
        }

        $inventoryModel = new CustomerInventoryModel();
        $childBarcodeModel = new CustomerInventoryChildBarcodeModel();
        $barcodeModel = new BarcodeModel();

        $inventory = $inventoryModel->find($itemId);
        if (!$inventory) {
            return $this->response->setJSON(['success' => false, 'message' => 'Inventory item not found']);
        }

        // Check if barcode already exists for this item
        $existing = $barcodeModel->where('rack_product_id', $itemId)->first();
        if ($existing) {
            return $this->response->setJSON(['success' => false, 'message' => 'Barcode already exists for this item.']);
        }

        // Generate new parent barcode
        $lastBarcode = $barcodeModel->orderBy('id', 'DESC')->first();
        $nextId = $lastBarcode ? $lastBarcode['id'] + 1 : 1;
        $parentBarcode = 'PNV-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        // Generate barcode image with text
        $parentImagePath = '/barcodes/' . $parentBarcode . '.png';
        $this->generateBarcodeWithText($parentBarcode, $parentImagePath);

        // Save parent barcode
        $barcodeModel->insert([
            'rack_product_id'   => $itemId,
            'barcode_value'     => $parentBarcode,
            'qr_image_path'     => $parentImagePath,
            'generated_by'      => session()->get('username') ?? 'system',
            'generated_at'      => date('Y-m-d H:i:s'),
            'parent_barcode_id' => null
        ]);

        // Insert child barcodes
        $quantity = (int)$inventory['quantity'];
        for ($i = 1; $i <= $quantity; $i++) {
            $childCode = $parentBarcode . '-' . $i;
            $childImagePath = 'barcodes/' . $childCode . '.png';
            $this->generateBarcodeWithText($childCode, $childImagePath);

            $childBarcodeModel->insert([
                'inventory_id'         => $itemId,
                'child_barcode_value'  => $childCode,
                'serial_number'        => $i,
                'item_status'          => 'in',
                'qr_image_path'        => $childImagePath,
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Parent and child barcodes generated successfully.',
            'parent_barcode' => $parentBarcode
        ]);
    }

    // 🔧 Generates barcode image with text below
    private function generateBarcodeWithText($code, $path)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($code, $generator::TYPE_CODE_128, 2, 60);

        $barcodeImg = imagecreatefromstring($barcode);

        $width = imagesx($barcodeImg);
        $height = imagesy($barcodeImg);

        $fontSize = 4;
        $textHeight = 20;

        $finalImage = imagecreatetruecolor($width, $height + $textHeight);
        $white = imagecolorallocate($finalImage, 255, 255, 255);
        imagefill($finalImage, 0, 0, $white);

        imagecopy($finalImage, $barcodeImg, 0, 0, 0, 0, $width, $height);

        $black = imagecolorallocate($finalImage, 0, 0, 0);
        $textWidth = imagefontwidth($fontSize) * strlen($code);
        $x = ($width - $textWidth) / 2;
        imagestring($finalImage, $fontSize, $x, $height + 2, $code, $black);

        // Save image to path
        imagepng($finalImage, FCPATH . $path);

        imagedestroy($barcodeImg);
        imagedestroy($finalImage);
    }


    // public function pdfpage()
    // {

    //     return view('templates/header') . view('templates/sidebar') . view('Home/uploadpdf') . view('templates/htmlclose');
    // }

    public function uploadPdf()
    {
        $session = session();
        $uploadId = $session->get('upload_inventory_id');

        if ($this->request->getMethod() === 'post') {
            $file = $this->request->getFile('pdf_file');

            if (!$file->isValid()) {
                return redirect()->back()->with('error', $file->getErrorString());
            }

            $newName = $file->getRandomName();

            // ✅ Use full path to public/uploads/pdfs
            if ($file->move(ROOTPATH . 'public/uploads/pdfs/', $newName)) {
                $pdfModel = new \App\Models\UploadPdfModel();
                $pdfModel->insert([
                    'upload_inventory_id' => $uploadId,
                    'pdf_name' => $newName,
                ]);

                return redirect()->back()->with('success', 'PDF uploaded successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to move uploaded file.');
            }
        }

        // ✅ Use your actual view structure
        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/customer_uploadpdf')
            . view('templates/htmlclose');
    }
}
