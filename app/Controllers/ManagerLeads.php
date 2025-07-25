<?php

namespace App\Controllers;

use App\Models\PineInfoLeadModel;

class ManagerLeads extends BaseController
{
    public function getLeadsByManagerLocation($managerId)
    {
        $db = \Config\Database::connect();

        // Get the manager's assigned location
        $builder = $db->table('info_users');
        $builder->select('assign_location');
        $builder->where('id', $managerId);
        $manager = $builder->get()->getRow();

        if (!$manager) {
            return [];
        }

        // Fetch leads based on location
        $builder = $db->table('pine_upload_inventory');
        $builder->where('moving_from', $manager->assign_location);
        return $builder->get()->getResult();
    }



    public function managerDashboard()
    {
        $session = session();
        $userRole = $session->get('role');
        $userId   = $session->get('id');

        if ($userRole != 'manager') {
            return redirect()->to('/dashboard'); // redirect others
        }

        $inventoryModel = new PineInfoLeadModel();
        $leads = $inventoryModel->getLeadsByManagerLocation($userId);

        return view('Managerpages/dashboard', [
            'leads' => $leads
        ]);
    }





    public function managerBarcodeList()
    {
        $db = \Config\Database::connect();
        $session = session();

        $userRole = $session->get('user_role');
        $userId   = $session->get('user_id');

        if ($userRole !== 'manager') {
            return redirect()->to('/')->with('error', 'Access denied.');
        }

        // Get manager's assigned city names (like 'Mumbai', 'Delhi')
        $user = $db->table('info_users')->where('user_id', $userId)->get()->getRow();
        $assignedCities = [];

        if ($user && !empty($user->assign_location)) {
            $assignedCities = array_map('trim', explode(',', $user->assign_location));
        }

        $builder = $db->table('pine_store_warehouse_barcodes b');
        $builder->select('b.*, i.item_name, p.id AS customer_id, p.customer_name, p.moving_to');
        $builder->join('customer_inventory i', 'i.id = b.rack_product_id', 'left');
        $builder->join('pine_upload_inventory p', 'p.id = i.upload_inventory_id', 'left');
        $builder->orderBy('b.generated_at', 'DESC');

        // Apply filter by city name
        if (!empty($assignedCities)) {
            $builder->whereIn('p.moving_to', $assignedCities);
        } else {
            // Show nothing if manager has no assigned cities
            $builder->where('p.id', 0);
        }

        // Optional search filters
        $customerName = $this->request->getGet('customer_name');
        $customerId   = $this->request->getGet('customer_id');

        if (!empty($customerName)) {
            $builder->like('p.customer_name', $customerName);
        }

        if (!empty($customerId)) {
            $builder->where('p.id', $customerId);
        }

        $query = $builder->get();
        $data['barcodes'] = $query->getResultArray();

        $data['filters'] = [
            'customer_name' => $customerName,
            'customer_id' => $customerId,
        ];

        return view('templates/header')
            . view('templates/sidebar')
            . view('Home/barcode_list', $data)
            . view('templates/htmlclose');
    }


    public function managerPdfList()
    {
        $session = session();
        $managerId = $session->get('id'); // manager session ID

        $db = \Config\Database::connect();

        // Assuming you have a `assign_location` table mapping managers to cities
        $pdfs = $db->query("
        SELECT up.id, up.pdf_name, pi.customer_name, pi.city
        FROM upload_pdf up
        JOIN pine_upload_inventory pi ON up.upload_inventory_id = pi.id
        JOIN assign_location al ON pi.city = al.city
        WHERE al.manager_id = ?", [$managerId])->getResult();

        return view('Home/pdf_list', ['pdfs' => $pdfs]);
    }
}
