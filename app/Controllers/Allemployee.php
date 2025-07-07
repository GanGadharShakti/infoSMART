<?php

namespace App\Controllers;

use App\Models\UserModel;

class Allemployee extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll(); // Fetch all users

        return view('templates/header') . view('templates/sidebar') . view('Home/employee',  $data) . view('templates/htmlclose'); // Load view
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);

        return view('templates/header') . view('templates/sidebar') . view('Home/edit_user', $data) . view('templates/htmlclose');
    }

    public function update($id)
    {
        $model = new UserModel();
        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'assign_location' => $this->request->getPost('assign_location'),
            'user_role' => $this->request->getPost('user_role'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/allemployee');
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $model = new UserModel();
        $model->delete($id);
        return $this->response->setJSON(['success' => true]);
    }
}
