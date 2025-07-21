<?php

namespace App\Models;

use CodeIgniter\Model;

class Warehouse extends Model
{
    protected $DBGroup = 'warehouse';
    protected $table = 'cities';
    protected $allowedFields = ['city_name', 'slug', 'contact_number', 'email'];
}
