<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'info_users';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'name',
        'email',
        'phone_number',
        'address',
        'password',
        'assign_location',
        'user_role',
        'status',
        'created_at',
        'updated_at'
    ];
}
