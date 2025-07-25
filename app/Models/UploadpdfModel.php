<?php

namespace App\Models;

use CodeIgniter\Model;

class UploadPdfModel extends Model
{
    protected $table = 'upload_pdf';
    protected $primaryKey = 'id';
    protected $allowedFields = ['upload_inventory_id', 'pdf_name', 'created_at', 'updated_at'];
}
