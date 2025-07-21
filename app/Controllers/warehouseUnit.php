<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Warehouseunit;

class StorageUnitController extends BaseController
{
    protected $storageModel;

    public function __construct()
    {
        // Use different DB group if needed
        $this->storageModel = new Warehouseunit(); // This model can use alternate DB
    }

    // Show all storage units
    public function index()
    {
        $data['units'] = $this->storageModel->findAll();
        return view('storage_units/index', $data);
    }

    // Show form to create new unit
    public function create()
    {
        return view('storage_units/create_edit');
    }

    // Store new unit
    public function store()
    {
        $data = $this->getFormData();
        $this->storageModel->insert($data);
        return redirect()->to('/storage-units')->with('message', 'Storage Unit Added Successfully');
    }

    // Show form to edit existing unit
    public function edit($id)
    {
        $data['unit'] = $this->storageModel->find($id);
        return view('storage_units/create_edit', $data);
    }

    // Update existing unit
    public function update($id)
    {
        $data = $this->getFormData();
        $this->storageModel->update($id, $data);
        return redirect()->to('/storage-units')->with('message', 'Storage Unit Updated Successfully');
    }

    // Delete a unit
    public function delete($id)
    {
        $this->storageModel->delete($id);
        return redirect()->to('/storage-units')->with('message', 'Storage Unit Deleted Successfully');
    }

    // Get form data safely
    private function getFormData()
    {
        return [
            'city_id'       => $this->request->getPost('city_id'),
            'short_title'   => $this->request->getPost('short_title'),
            'unit_size'     => $this->request->getPost('unit_size'),
            'price'         => $this->request->getPost('price'),
            'image'         => $this->request->getPost('image'),
            'sq_ft'         => $this->request->getPost('sq_ft'),
            'has_wifi'      => $this->request->getPost('has_wifi') ? 1 : 0,
            'has_camera'    => $this->request->getPost('has_camera') ? 1 : 0,
            'has_lock'      => $this->request->getPost('has_lock') ? 1 : 0,
            'has_truck'     => $this->request->getPost('has_truck') ? 1 : 0,
            'unit_features' => $this->request->getPost('unit_features'),
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ];
    }
}
