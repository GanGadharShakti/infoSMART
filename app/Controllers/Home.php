<?php

namespace App\Controllers;

// use App\Models\EleUserModel;
use App\Models\UserModel;
use App\Models\WarehouseModel;

class Home extends BaseController
{

    public function index()


    {
        // $user_role = new UserModel();
        // $user = $user_role->findAll();

        $warehouseModel = new WarehouseModel();
        $cards = $warehouseModel->findAll();
        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/index', ['cards' => $cards])
            . view('templates/htmlclose');
    }

    public function login()
    {

        return view('Home/login');
    }


    public function logout()
    {
        session()->destroy(); // Destroy all session data
        return redirect()->to('/'); // Redirect to login or home page
    }


    public function fetchLeads($page = 1)
    {
        $model = new \App\Models\PineInfoLeadModel(); // Your updated model

        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $leads = $model->getLeadsWithPagination($perPage, $offset);
        $totalLeads = $model->countAllLeads();
        $totalPages = ceil($totalLeads / $perPage);

        return $this->response->setJSON([
            'leads' => $leads,
            'totalPages' => $totalPages
        ]);
    }




    // public function inventory()
    // {
    //     // redirect('/invetory_Page');
    // }
    public function UserDeatails()
    {


        return view('templates/sidebar');
        // return view('Home/home');
    }

    // Additional views
    public function table()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/table') . view('templates/htmlclose');
    }
    public function customers()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/customers') . view('templates/htmlclose');
    }
    public function employee()
    {

        return view('templates/header') . view('templates/sidebar') . view('Home/employee') . view('templates/htmlclose');
    }

    public function register()
    {
        $warehouseModel = new warehouseModel();

        $data['warehouses'] = $warehouseModel->findAll();

        // return view('Home/register', $data);
        return view('templates/header') . view('templates/sidebar') . view('Home/register', $data) . view('templates/htmlclose');
    }

    public function save()
    {
        $validation = \Config\Services::validation();
        $request = service('request');

        $rules = [
            'name'            => 'required|min_length[3]',
            'email'           => 'required|valid_email|is_unique[info_users.email]',
            'phone_number'    => 'required|numeric|exact_length[10]',
            'password'        => 'required',
            'assign_location' => 'required',
            'user_role'       => 'required|in_list[admin,manager,telecaller]'
        ];

        $messages = [
            'email' => ['is_unique' => 'This email is already registered.'],
            'user_role' => ['in_list' => 'Please select a valid role.']
        ];

        if (!$this->validate($rules, $messages)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors()
            ]);
        }

        $model = new UserModel();

        $data = [
            'name'            => $request->getPost('name'),
            'email'           => $request->getPost('email'),
            'phone_number'    => $request->getPost('phone_number'),
            'password'        => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'assign_location' => $request->getPost('assign_location'),
            'user_role'       => $request->getPost('user_role'),
            'address'         => '', // default empty if not present in form
        ];

        $model->insert($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User registered successfully!'
        ]);
    }
    public function upload_inventory()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/upload_inventory') . view('templates/htmlclose');
    }



    public function getWarehouses()
    {
        $warehouseModel = new WarehouseModel();
        return $this->response->setJSON($warehouseModel->findAll());
    }
    public function inventorylist()
    {
        return view('templates/header') . view('templates/sidebar') . view('Home/inventory_items') . view('templates/htmlclose');
    }
}
