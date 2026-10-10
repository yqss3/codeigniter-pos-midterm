<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();
        $data['customers'] = $model->findAll();

        return view('customers/index', $data);
    }
}
