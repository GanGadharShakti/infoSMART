<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PineInfoLeadModel;
use App\Models\PineUploadInventoryModel;
use App\Models\CustomerInventoryModel;

class Leads extends BaseController
{
    public function inventory($leadId)
    {
        $leadModel = new PineInfoLeadModel();
        $uploadModel = new PineUploadInventoryModel();
        $inventoryModel = new CustomerInventoryModel();

        $lead = $leadModel->find($leadId);
        if (!$lead) {
            return redirect()->to('/leads')->with('error', 'Lead not found.');
        }

        $upload = $uploadModel->where('id', $lead['upload_inventory_id'])->first();
        if (!$upload) {
            return redirect()->to('/leads')->with('error', 'Customer upload not found.');
        }

        $inventories = $inventoryModel
            ->where('upload_inventory_id', $upload['id'])
            ->findAll();

        return view('Home/admin_customer_inventory', [
            'lead' => $lead,
            'customer' => $upload,
            'inventories' => $inventories
        ]);
    }
}
