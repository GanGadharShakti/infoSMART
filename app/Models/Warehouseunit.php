<?php

namespace App\Models;

use CodeIgniter\Model;

class Warehouseunit extends Model
{
    // Do NOT define protected $DBGroup
    protected $table      = 'storage_units';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'city_id',
        'unit_size',
        'short_title',
        'price',
        'image',
        'sq_ft',
        'has_wifi',
        'has_camera',
        'has_lock',
        'has_truck',
        'unit_features',
        'is_active',
        'created_at'
    ];
}
