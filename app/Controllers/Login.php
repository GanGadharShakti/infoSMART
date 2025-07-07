<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        $userRole = session()->get('user_role');

        if ($userRole === 'admin') {
            return view('templates/header')
                . view('dashboard_admin') // create this file
                . view('templates/htmlclose');
        } elseif ($userRole === 'manager') {
            return redirect()->to('/customers');
        } elseif ($userRole === 'customer') {
            return redirect()->to('/inventorylist');
        } else {
            return redirect()->to('/');
        }
    }


    public function login()
    {
        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');

        $model = new UserModel();

        // Case-insensitive email match
        $user = $model->where('LOWER(email)', strtolower($email))->first();

        if ($user) {
            $hashedPassword = $user['password'];

            if (crypt($password, $hashedPassword) === $hashedPassword) {
                // Set session
                session()->set('user_id', $user['user_id']);
                session()->set('user_email', $user['email']);
                $name = session()->set('user_name', $user['name']); // 👈 Store user name here

                session()->setFlashdata('success', 'Login successful!');
                return redirect()->to('/dashboard', $name);
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
}
