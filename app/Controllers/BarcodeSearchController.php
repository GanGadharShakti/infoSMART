<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BarcodeSearchController extends BaseController
{



    public function searchView()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_search_view')
            . view('templates/htmlclose');
    }

    public function search($type, $rackId)
    {
        $db = \Config\Database::connect();

        if ($type === "box") {
            // Search in parent (box) barcodes using rack_product_id
            $parent = $db->table('pine_store_warehouse_barcodes b')
                ->select('b.*, i.item_name, c.customer_name, c.id as customer_id, c.customer_mobile, c.customer_email')
                ->join('customer_inventory i', 'i.id = b.rack_product_id', 'left')
                ->join('pine_upload_inventory c', 'c.id = i.upload_inventory_id', 'left')
                ->where('b.rack_product_id', $rackId)
                ->get()
                ->getRow();

            if (!$parent) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No box barcode found for this Rack ID']);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'barcode' => $parent,
                'customer' => $parent,
                'item' => $parent
            ]);
        }


        if ($type === "item") {
            // Search in child barcodes using inventory_id
            $child = $db->table('customer_inventory_child_barcodes cb')
                ->select('cb.*, i.item_name, i.rack_id, c.customer_name, c.id as customer_id, c.customer_mobile, c.customer_email')
                ->join('customer_inventory i', 'i.id = cb.inventory_id', 'left')
                ->join('pine_upload_inventory c', 'c.id = i.upload_inventory_id', 'left')
                ->where('cb.inventory_id', $rackId)
                ->get()
                ->getResult();

            if (!$child || count($child) == 0) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'No item barcode found for this Inventory ID']);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'barcode' => $child,
                'customer' => $child,
                'item' => $child
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid search type']);
    }
}
