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
                . view('templates/sidebar')
                . view('dashboard_admin') // ✅ Make sure this view exists
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

                // ✅ Role-based redirection
                $role = $user['user_role'];
                if ($role === 'admin') {
                    return redirect()->to('/dashboard');
                } elseif ($role === 'manager') {
                    return redirect()->to('/dashboard');
                } elseif ($role === 'customer') {
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
}
