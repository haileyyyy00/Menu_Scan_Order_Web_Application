<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'Order';
    protected $primaryKey       = 'order_id';
    protected $allowedFields    = ['user_id', 'table_number','created_at','status']; 
    protected $returnType       = 'array';
}