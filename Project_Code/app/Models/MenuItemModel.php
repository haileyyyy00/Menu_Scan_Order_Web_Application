<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuItemModel extends Model
{
    protected $table            = 'Menu_Item';
    protected $primaryKey       = 'menu_item_id';
    protected $allowedFields    = ['name', 'category', 'price', 'description', 'menu_item_id', 'menu_id']; 
    protected $returnType       = 'array';
}
