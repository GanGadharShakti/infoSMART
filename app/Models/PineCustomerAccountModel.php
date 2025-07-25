<?php

namespace App\Models;

use CodeIgniter\Model;

class PineCustomerAccountModel extends Model
{
    protected $table = 'pine_customer_accounts';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_id',
        'customer_name',
        'mobile_no',
        'email',
        'password',
        'account_type',
        'device_id',
        'session_token',
        'is_logged_in',
        'last_login_time',
        'max_devices',
        'profile_image',
        'created_at'
    ];

    protected $useTimestamps = false; // since created_at is handled by MySQL default
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    // Optional validation rules
    protected $validationRules = [
        'email' => 'required|valid_email',
        'password' => 'required|min_length[4]',
        'account_type' => 'in_list[corporate,user]',
    ];

    protected $validationMessages = [
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 4 characters long',
        ],
        'account_type' => [
            'in_list' => 'Account type must be either corporate or user',
        ],
    ];
}
