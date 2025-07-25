<?php

namespace App\Controllers;

// use App\Models\PineInfoLeadModel;

class CunstomerLogin extends BaseController
{



    public function cunstomerDashboard()
    {

        return view('templates/header') . view('templates/sidebar') . view('Customer/customerDashboard') . view('templates/htmlclose');
    }
}
