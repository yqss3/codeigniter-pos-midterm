<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'username',
        'password_hash',
        'full_name',
        'role',
        'email'
    ];
}
