<?php

namespace App\Controllers;

use App\Models\Warehouse;
use App\Models\WarehouseModel;
use App\Models\Warehouseunit;
use CodeIgniter\Controller;

class WarehouseController extends Controller
{
    public function index()
    {
        $model = new WarehouseModel();
        $data['warehouses'] = $model->findAll();
        return view('templates/header') . view('templates/sidebar') . view('Warehouse/warehouse', $data) . view('templates/htmlclose');
    }

    public function create()
    {
        return view('templates/header') . view('templates/sidebar') . view('Warehouse/creatwarehouse') . view('templates/htmlclose');
    }

    // public function store()
    // {
    //     $model = new WarehouseModel();

    //     $cityName = $this->request->getPost('city_name');

    //     $data = [
    //         'city_name'      => $cityName,
    //         'slug'           => $this->generateSlug($cityName),
    //         'contact_number' => $this->request->getPost('contact_number'),
    //         'email'          => $this->request->getPost('email'),
    //     ];

    //     $model->save($data);
    //     return redirect()->to('/warehouse')->with('message', 'City created successfully.');
    // }

    public function store()
    {
        $data = [
            'city_name'      => $this->request->getPost('city_name'),
            'slug'           => strtolower(url_title($this->request->getPost('city_name'))),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $infosmartModel = new Warehouse();
        $warehouseModel = new WarehouseModel();

        // First insert into infosmart (default DB)
        if ($infosmartModel->insert($data)) {

            // Also insert into warehouse DB if not already present
            $existing = $warehouseModel->where('city_name', $data['city_name'])->first();

            if (!$existing) {
                $warehouseModel->insert($data);
            }

            return redirect()->to(base_url('warehouse'))->with('success', 'City added successfully in both DBs.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to add city.');
        }
    }

    public function edit($id)
    {
        $model = new WarehouseModel();
        $data['warehouse'] = $model->find($id);

        if (!$data['warehouse']) {
            return redirect()->to('/warehouse')->with('error', 'City not found.');
        }

        return view('templates/header') . view('templates/sidebar') . view('Warehouse/creatwarehouse', $data) . view('templates/htmlclose');
    }


    public function update($id)
    {
        $infosmartModel  = new \App\Models\WarehouseModel();         // Default DB
        $warehouseModel  = new \App\Models\Warehouse();     // Second DB

        $cityName = $this->request->getPost('city_name');

        $data = [
            'city_name'      => $cityName,
            'slug'           => $this->generateSlug($cityName),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        // 1. Update in infosmart
        $infosmartModel->update($id, $data);

        // 2. Mirror update in warehouse
        $existing = $warehouseModel->where('city_name', $cityName)->first();
        if ($existing) {
            $warehouseModel->update($existing['id'], $data);
        } else {
            // Insert if not present (in case it was deleted manually)
            $warehouseModel->insert($data);
        }

        return redirect()->to('/warehouse')->with('message', 'City updated successfully in both databases.');
    }


    public function delete($id)
    {
        $infosmartModel  = new \App\Models\WarehouseModel();         // Default DB
        $warehouseModel  = new \App\Models\Warehouse();     // Second DB

        // First get the city by ID from infosmart DB
        $city = $infosmartModel->find($id);

        if ($city) {
            // 1. Delete from infosmart DB
            $infosmartModel->delete($id);

            // 2. Also delete from warehouse DB by city_name
            $warehouseModel->where('city_name', $city['city_name'])->delete();
        }

        return redirect()->to('/warehouse')->with('message', 'City deleted successfully from both databases.');
    }



    // ✅ Slug generator function
    private function generateSlug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return rtrim($slug, '-');
    }
    public function view($id)
    {
        $warehouseModel = new WarehouseModel();
        $warehouse = $warehouseModel->find($id);

        if (!$warehouse) {
            return redirect()->to('/warehouse')->with('error', 'Warehouse not found.');
        }

        // Load warehouse_locations where city_id = warehouse_id
        $db = \Config\Database::connect();
        $builder = $db->table('warehouse_locations');
        $builder->where('city_id', $id);
        $locations = $builder->get()->getResultArray();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Warehouse/view_locations', ['warehouse' => $warehouse, 'locations' => $locations])
            . view('templates/htmlclose');
    }

    public function unitcreate()
    {
        return view('Warehouse/warehouseunitedit');
    }

    public function unitedit($id)
    {
        $model = new Warehouseunit();
        $data['unit'] = $model->find($id);

        return view('Warehouse/warehouseunitedit', $data);
    }
}
