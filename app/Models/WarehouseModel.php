<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model
{
    protected $table      = 'cities';
    protected $primaryKey = 'id';

    protected $allowedFields = ['city_name', 'slug', 'contact_number', 'email'];

    protected $useAutoIncrement = true;
    protected $useTimestamps    = false; // Because `created_at` is present in your cities table
    protected $createdField     = 'created_at';
}
