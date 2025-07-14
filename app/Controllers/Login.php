<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PineInfoLeadModel;

class Login extends BaseController
{


    public function login()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('LOWER(email)', strtolower($email))->first();

        if ($user) {
            $hashedPassword = $user['password'];

            if (crypt($password, $hashedPassword) === $hashedPassword) {
                // ✅ Set all required session variables
                session()->set([
                    'user_id'    => $user['user_id'],
                    'user_email' => $user['email'],
                    'user_name'  => $user['name'],
                    'user_role'  => $user['user_role'],
                    'assign_location' => $user['assign_location'],
                ]);

                session()->setFlashdata('success', 'Login successful!');

                $customerislogin =  session()->get('isLoggedIn');
                // ✅ Role-based redirection
                $role = $user['user_role'];
                if ($role === 'admin') {
                    return redirect()->to('/dashboard');
                } elseif ($role === 'manager') {
                    return redirect()->to('/customers');
                } elseif ($customerislogin) {
                    return redirect()->to('/inventorylist');
                } else {
                    return redirect()->to('/')->with('error', 'Invalid role.');
                }
            } else {
                return redirect()->back()->with('error', 'Incorrect password.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Destroy session
        return redirect()->to('/')->with('success', 'You have been logged out.');
    }




    // customer login



    public function loginView()
    {
        return view('Home/customer_login'); // Path to your login view
    }

    public function customerlogin()
    {
        $session = session();
        $email = trim($this->request->getPost('email'));
        $password = trim($this->request->getPost('password'));

        $model = new \App\Models\PineInfoLeadModel();
        $customer = $model->where('cust_wr_email', $email)->first();

        if ($customer) {
            if (trim($customer['cust_wr_pass']) === $password) {
                // ✅ Set session with proper keys to work with sidebar logic
                $sessionData = [
                    'customer_id'        => $customer['id'],
                    'user_name'      => $customer['customer_name'],
                    'customer_name'  => $customer['customer_name'],
                    'user_role'      => 'customer', // this is very important
                    'isLoggedIn'     => true,
                ];
                $session->set($sessionData);

                return redirect()->to('/inventorylist');
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }


    public function customerInventory()
    {
        $customerId = session()->get('customer_id'); // This is pine_upload_inventory.id

        if (!$customerId) {
            return redirect()->to('/cus_login')->with('error', 'Please login first.');
        }

        // Load model
        $inventoryModel = new \App\Models\CustomerInventoryModel();

        // Find customer inventory where upload_inventory_id matches customer ID
        $data['inventories'] = $inventoryModel
            ->where('upload_inventory_id', $customerId)
            ->findAll();

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/inventory_items', $data)
            . view('templates/htmlclose');
    }




    public function customerlogout()
    {
        session()->destroy(); // Destroy session
        return redirect()->to('/cur_login')->with('success', 'You have been logged out.');
    }


    public function index()
    {
        $userRole = session()->get('user_role');
        $PineInfoLeadModel = session()->get("isLoggedIn");

        if ($userRole === 'admin') {
            return view('templates/header')
                . view('templates/sidebar')
                . view('dashboard_admin') // ✅ Make sure this view exists
                . view('templates/htmlclose');
        } elseif ($userRole === 'manager') {
            return redirect()->to('/customers');
        } elseif ($userRole == 'customer') {
            return redirect()->to('/inventorylist');
        } else {
            return redirect()->to('/');
        }
    }
}
