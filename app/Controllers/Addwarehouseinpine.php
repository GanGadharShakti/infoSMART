<?php

namespace App\Controllers;
use App\Models\Warehouse;
use App\Models\WarehouseModel;

class Addwarehouseinpine extends BaseController
{
    public function addCity()
    {
        $data = [
            'city_name'      => $this->request->getPost('city_name'),
            'slug'           => $this->request->getPost('slug'),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $infosmartModel = new Warehouse();
        $warehouseModel = new WarehouseModel();

        // Insert into infosmart DB
        if ($infosmartModel->insert($data)) {
            // Mirror into warehouse DB
            $warehouseModel->insert($data);

            return redirect()->back()->with('success', 'City added to both databases');
        } else {
            return redirect()->back()->with('error', 'Failed to insert');
        }
    }
}
