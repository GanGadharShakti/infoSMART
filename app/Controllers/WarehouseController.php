<?php

namespace App\Controllers;

use App\Models\WarehouseModel;
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
        return view('templates/header') . view('templates/sidebar') . view('Warehouse/creatwarehouse') . view('templates/htmlclose'); // Reuse form for create
    }

    public function store()
    {
        $model = new WarehouseModel();

        $data = [
            'state' => $this->request->getPost('state'),
            'city'  => $this->request->getPost('city'),
        ];

        $model->save($data);
        return redirect()->to('/warehouse')->with('message', 'Warehouse created successfully.');
    }

    public function edit($id)
    {
        $model = new WarehouseModel();
        $data['warehouse'] = $model->find($id);

        if (!$data['warehouse']) {
            return redirect()->to('/warehouse')->with('error', 'Warehouse not found.');
        }

        return view('templates/header') . view('templates/sidebar') . view('Warehouse/creatwarehouse', $data) . view('templates/htmlclose');; // Reuse form for edit
    }

    public function update($id)
    {
        $model = new WarehouseModel();

        $data = [
            'state' => $this->request->getPost('state'),
            'city'  => $this->request->getPost('city'),
        ];

        $model->update($id, $data);
        return redirect()->to('/warehouse')->with('message', 'Warehouse updated successfully.');
    }

    public function delete($id)
    {
        $model = new WarehouseModel();
        $model->delete($id);
        return redirect()->to('/warehouse')->with('message', 'Warehouse deleted successfully.');
    }
}
