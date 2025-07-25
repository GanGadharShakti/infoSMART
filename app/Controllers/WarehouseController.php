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
        return view('templates/header')
            . view('templates/sidebar')
            . view('Warehouse/warehouse', $data)
            . view('templates/htmlclose');
    }

    public function create()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Warehouse/creatwarehouse')
            . view('templates/htmlclose');
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'city_name' => 'required|min_length[2]',
            'contact_number' => 'required|numeric|exact_length[10]',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'city_name'      => $this->request->getPost('city_name'),
            'slug'           => strtolower(url_title($this->request->getPost('city_name'))),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $infosmartModel = new Warehouse();         // Default DB
        $warehouseModel = new WarehouseModel();    // Second DB

        if ($infosmartModel->insert($data)) {
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

        return view('templates/header')
            . view('templates/sidebar')
            . view('Warehouse/creatwarehouse', $data)
            . view('templates/htmlclose');
    }

    public function update($id)
    {
        helper(['form']);

        $rules = [
            'city_name' => 'required|min_length[2]',
            'contact_number' => 'required|numeric|exact_length[10]',
            'email' => 'required|valid_email'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $infosmartModel  = new WarehouseModel();  // Default DB
        $warehouseModel  = new Warehouse();       // Second DB

        $cityName = $this->request->getPost('city_name');

        $data = [
            'city_name'      => $cityName,
            'slug'           => $this->generateSlug($cityName),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $infosmartModel->update($id, $data);

        $existing = $warehouseModel->where('city_name', $cityName)->first();
        if ($existing) {
            $warehouseModel->update($existing['id'], $data);
        } else {
            $warehouseModel->insert($data);
        }

        return redirect()->to('/warehouse')->with('message', 'City updated successfully in both databases.');
    }

    public function delete($id)
    {
        $infosmartModel  = new WarehouseModel();
        $warehouseModel  = new Warehouse();

        $city = $infosmartModel->find($id);

        if ($city) {
            $infosmartModel->delete($id);
            $warehouseModel->where('city_name', $city['city_name'])->delete();
        }

        return redirect()->to('/warehouse')->with('message', 'City deleted successfully from both databases.');
    }

    private function generateSlug($string)
    {
        return rtrim(strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string))), '-');
    }

    public function view($id)
    {
        $warehouseModel = new WarehouseModel();
        $warehouse = $warehouseModel->find($id);

        if (!$warehouse) {
            return redirect()->to('/warehouse')->with('error', 'Warehouse not found.');
        }

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
