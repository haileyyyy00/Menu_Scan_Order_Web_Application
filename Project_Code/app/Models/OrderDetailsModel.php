<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailsModel extends Model
{
    protected $table            = 'Order_Details';
    protected $primaryKey       = 'order_details_id';
    protected $allowedFields    = ['menu_item_id','user_id','table_number','created_at','quantity']; 
    protected $returnType       = 'array';
}