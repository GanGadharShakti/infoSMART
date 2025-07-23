<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CustomerInventoryChildBarcodeModel;

class ChildBarcodeController extends BaseController
{
    /**
     * Show the view with dropdown to search by inventory_id
     */
    public function viewPage()
    {
        $db = \Config\Database::connect();
        $inventory = $db->table('customer_inventory')
            ->select('id, item_name')
            ->get()
            ->getResultArray();

        return view('templates/header') . view('templates/sidebar') . view('Home/child_barcodes_view', ['inventory' => $inventory]) . view('templates/htmlclose');
    }

    /**
     * Fetch child barcodes by inventory_id (AJAX)
     */
    public function getByInventoryId($inventory_id)
    {
        $model = new CustomerInventoryChildBarcodeModel();
        $data = $model->where('inventory_id', $inventory_id)->findAll();

        return $this->response->setJSON($data);
    }

    /**
     * Add new child barcode (AJAX POST)
     */
    public function add()
    {
        $model = new CustomerInventoryChildBarcodeModel();

        try {
            $data = [
                'inventory_id' => $this->request->getPost('inventory_id'),
                'child_barcode_value' => $this->request->getPost('child_barcode_value'),
                'serial_number' => $this->request->getPost('serial_number'),
                'qr_image_path' => $this->request->getPost('qr_image_path'),
            ];

            if ($model->insert($data)) {
                return $this->response->setJSON(['status' => 'success']);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => $model->errors()
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Delete child barcode by ID (AJAX DELETE)
     */
    public function delete($id)
    {
        $model = new CustomerInventoryChildBarcodeModel();

        if ($model->delete($id)) {
            return $this->response->setJSON(['status' => 'deleted']);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Deletion failed'
        ]);
    }

    public function getCustomerAndBarcodes($inventory_id)
    {
        $db = \Config\Database::connect();

        // Get inventory item
        $inventory = $db->table('customer_inventory')
            ->where('id', $inventory_id)
            ->get()
            ->getRow();

        if (!$inventory) {
            return $this->response->setJSON(['status' => 'not_found']);
        }

        // Get customer data from pine_upload_inventory
        $customer = $db->table('pine_upload_inventory')
            ->where('id', $inventory->upload_inventory_id)
            ->get()
            ->getRow();

        // Get child barcodes
        $barcodes = $db->table('customer_inventory_child_barcodes')
            ->where('inventory_id', $inventory_id)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'status' => 'success',
            'customer' => $customer,
            'barcodes' => $barcodes
        ]);
    }
    public function markOut($id)
    {
        $model = new CustomerInventoryChildBarcodeModel();

        $barcode = $model->find($id);

        if (!$barcode) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Child barcode not found.'
            ]);
        }

        $updated = $model->update($id, ['item_status' => 'out']);

        if ($updated) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Barcode marked as out.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to update barcode.'
        ]);
    }
}
