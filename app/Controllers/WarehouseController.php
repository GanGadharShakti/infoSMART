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
        return view('templates/header') . view('templates/sidebar') . view('Warehouse/creatwarehouse') . view('templates/htmlclose');
    }

    public function store()
    {
        $model = new WarehouseModel();

        $cityName = $this->request->getPost('city_name');

        $data = [
            'city_name'      => $cityName,
            'slug'           => $this->generateSlug($cityName),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $model->save($data);
        return redirect()->to('/warehouse')->with('message', 'City created successfully.');
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
        $model = new WarehouseModel();

        $cityName = $this->request->getPost('city_name');

        $data = [
            'city_name'      => $cityName,
            'slug'           => $this->generateSlug($cityName),
            'contact_number' => $this->request->getPost('contact_number'),
            'email'          => $this->request->getPost('email'),
        ];

        $model->update($id, $data);
        return redirect()->to('/warehouse')->with('message', 'City updated successfully.');
    }

    public function delete($id)
    {
        $model = new WarehouseModel();
        $model->delete($id);
        return redirect()->to('/warehouse')->with('message', 'City deleted successfully.');
    }

    // ✅ Slug generator function
    private function generateSlug($string)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return rtrim($slug, '-');
    }
}
