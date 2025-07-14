<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerInventoryModel extends Model
{
    protected $table = 'customer_inventory';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'upload_inventory_id',
        'item_name',
        'quantity',
        'assemble_disassemble',
        'wood_crating',
        'wall_dismounting',
        'extra_int',
        'inventory_status',
        'created_date'
    ];
}
