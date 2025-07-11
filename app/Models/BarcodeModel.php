<?php

namespace App\Models;

use CodeIgniter\Model;

class BarcodeModel extends Model
{
    protected $table = 'pine_store_warehouse_barcodes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'rack_product_id',
        'barcode_value',
        'qr_image_path',
        'generated_by'
    ];
}
