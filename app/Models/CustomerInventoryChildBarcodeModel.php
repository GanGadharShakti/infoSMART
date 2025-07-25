<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerInventoryChildBarcodeModel extends Model
{
    protected $table            = 'customer_inventory_child_barcodes';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'inventory_id',
        'child_barcode_value',
        'serial_number',
        'item_status',
        'qr_image_path'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
