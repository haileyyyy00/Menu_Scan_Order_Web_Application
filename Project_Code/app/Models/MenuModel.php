<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'Menu';
    protected $primaryKey       = 'menu_id';
    protected $allowedFields    = ['name', 'created_on', 'remarks', 'visible','user_id']; 
    protected $returnType       = 'array';
}
