<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('user_role');

        // Not logged in
        if (!$role) {
            return redirect()->to('/')->with('error', 'Please log in first.');
        }

        // If roles are specified and current user's role is not allowed
        if ($arguments && !in_array($role, $arguments)) {
            return redirect()->to('/')->with('error', 'Access denied.');
        }

        return null; // Allow access
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No need to handle after request
    }
}
