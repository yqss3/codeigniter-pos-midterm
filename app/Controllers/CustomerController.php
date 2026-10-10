<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    // Display all customers
    public function index()
    {
        $model = new CustomerModel();

        return view('customers/index', [
            'customers' => $model->findAll()
        ]);
    }

    // Display the Add Customer form
    public function create()
    {
        return view('customers/create');
    }

    // Save a new customer
    public function store()
    {
        $model = new CustomerModel();

        $rules = [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email',
            'phone'     => 'required|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please check your customer details.');
        }

        $model->insert([
            'full_name' => trim($this->request->getPost('full_name')),
            'email'     => trim($this->request->getPost('email')),
            'phone'     => trim($this->request->getPost('phone')),
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer added successfully!');
    }

    // Display the Edit Customer form
    public function edit($id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (!$customer) {
            return redirect()->to('/customers')
                ->with('error', 'Customer not found.');
        }

        return view('customers/edit', [
            'customer' => $customer
        ]);
    }

    // Update an existing customer
    public function update($id)
    {
        $model = new CustomerModel();
        $customer = $model->find($id);

        if (!$customer) {
            return redirect()->to('/customers')
                ->with('error', 'Customer not found.');
        }

        $rules = [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email'     => 'required|valid_email',
            'phone'     => 'required|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please check your customer details.');
        }

        $model->update($id, [
            'full_name' => trim($this->request->getPost('full_name')),
            'email'     => trim($this->request->getPost('email')),
            'phone'     => trim($this->request->getPost('phone')),
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Customer updated successfully!');
    }

    // Delete a customer
    public function delete($id)
    {
        $model = new CustomerModel();

        if (!$model->find($id)) {
            return redirect()->to('/customers')
                ->with('error', 'Customer not found.');
        }

        $model->delete($id);

        return redirect()->to('/customers')
            ->with('success', 'Customer deleted successfully!');
    }
}