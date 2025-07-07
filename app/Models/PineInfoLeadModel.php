<?php

namespace App\Models;

use CodeIgniter\Model;

class PineInfoLeadModel extends Model
{
    protected $table = 'pine_upload_inventory';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'customer_name',
        'customer_mobile',
        'optional_mobile',
        'customer_email',
        'campaign',
        'service_type',
        'moving_date',
        'moving_time',
        'source',
        'moving_type',
        'pincode',
        'city',
        'state',
        'moving_from',
        'moving_floor',
        'moving_to',
        'cubic_feet',
        'duration',
        'exact_duration',
        'warehouse',
        'service_list',
        'distance',
        'remarks',
        'extra_remarks',
        'quote_sent_date',
        'quote_sent_date2',
        'quote_sent_date3',
        'quote_sent_date4',
        'quote_sent_date5',
        'cust_quote_one',
        'cust_quote_two',
        'cust_quote_three',
        'cust_quote_four',
        'cust_quote_five',
        'additional_char',
        'insurance',
        'additional_inventory',
        'extra_int',
        'final_quote',
        'spanco',
        'welcome_mail_sent',
        'spanco_updated_at',
        'manager_id',
        'created_at'
    ];

    /**
     * Fetch only "Order" spanco leads with pagination
     */
    public function getLeadsWithPagination($limit, $offset)
    {
        return $this->where('spanco', 'Order')
            ->orderBy('id', 'DESC')
            ->findAll($limit, $offset);
    }

    /**
     * Count only leads where spanco is "Order"
     */
    public function countAllLeads()
    {
        return $this->where('spanco', 'Order')->countAllResults();
    }
}
