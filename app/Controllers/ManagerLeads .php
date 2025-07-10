<?php

namespace App\Controllers;

use App\Models\PineInfoLeadModel;

class ManagerLeads extends BaseController
{
    public function index()
    {
        $role = session()->get('user_role');
        if ($role !== 'manager') {
            return redirect()->to('/')->with('error', 'Access denied.');
        }

        return view('templates/header')
            . view('templates/sidebar')
            . view('leads/manager_leads') // 👈 your new view
            . view('templates/htmlclose');
    }

    public function fetchLeads($page = 1)
    {
        $model = new PineInfoLeadModel();

        $assignCity = session()->get('assign_location');
        $role = session()->get('user_role');

        if ($role !== 'manager') {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Unauthorized']);
        }

        $leads = $model->where('city', $assignCity)
            ->orderBy('id', 'DESC')
            ->paginate(10, 'default', $page);

        return $this->response->setJSON([
            'leads' => $leads,
            'pager' => $model->pager->links()
        ]);
    }
}
