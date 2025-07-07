<?php

namespace App\Models;

use CodeIgniter\Model;

class WarehouseModel extends Model
{
   protected $table = 'warehouse';
    protected $primaryKey = 'warehouse_id';
    protected $allowedFields = ['state', 'city'];
}
