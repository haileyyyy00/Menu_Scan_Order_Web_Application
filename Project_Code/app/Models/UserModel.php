<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'User';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = ['name', 'email', 'user_id', 'isAdmin', 'archived', 'status']; 
    protected $returnType       = 'array';
}
