<?php

namespace App\Controllers;

class Reports extends BaseController
{
    public function all_leads()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Reports/all_leads')
            . view('templates/htmlclose');
    }

    public function lost()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Reports/lost')
            . view('templates/htmlclose');
    }

    public function business()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Reports/business')
            . view('templates/htmlclose');
    }

    public function account_receivable()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Reports/account_receivable')
            . view('templates/htmlclose');
    }

    public function errorious_leads()
    {
        return view('templates/header')
            . view('templates/sidebar')
            . view('Reports/errorious_leads')
            . view('templates/htmlclose');
    }

    public function customer_list()
    {
        return view('templates/header')
        . view('templates/sidebar')
        . view('Reports/customer_list')
        . view('templates/htmlclose');
    }

    public function invoice_details()
    {
        return view('templates/header')
        . view('templates/sidebar')
        . view('Reports/invoice_details')
        . view('templates/htmlclose');
    }

    public function customer_payment_list()
    {
        return view('templates/header')
        . view('templates/sidebar')
        . view('Reports/customer_payment_list')
        . view('templates/htmlclose');
    }

    public function payment_list()
    {
        return view('templates/header')
        . view('templates/sidebar')
        . view('Reports/payment_list')
        . view('templates/htmlclose');
    }
    public function Rack_tracker (){
        // 
    }
}
