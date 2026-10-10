<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            [
                'username' => 'admin01',
                'name' => 'John Dela Cruz',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier01',
                'name' => 'Maria Santos',
                'role' => 'Cashier'
            ],
            [
                'username' => 'staff01',
                'name' => 'Pedro Reyes',
                'role' => 'Staff'
            ],
            [
                'username' => 'manager01',
                'name' => 'Ana Garcia',
                'role' => 'Manager'
            ],
            [
                'username' => 'cashier02',
                'name' => 'Jose Ramos',
                'role' => 'Cashier'
            ]
        ];

        return view('users', [
            'users' => $users
        ]);
    }
}
