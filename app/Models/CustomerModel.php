<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'customer_id';

    protected $allowedFields = [
        'full_name',
        'email',
        'phone',
        'address'
    ];
}
