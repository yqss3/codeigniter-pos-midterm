<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Display all staff members
    public function index()
    {
        $data['users'] = $this->userModel->findAll();

        return view('users/index', $data);
    }

    // Show the Add Staff form
    public function create()
    {
        return view('users/create');
    }

    // Save a new staff member
    public function store()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[2]|max_length[100]',
            'password' => 'required|min_length[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $avatarName = null;
        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $avatarName = $avatar->getRandomName();
            $avatar->move($uploadPath, $avatarName);
        }

        $this->userModel->insert([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'avatar' => $avatarName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff member added successfully.');
    }

    // Show the Edit Staff form
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);

        if (!$data['user']) {
            return redirect()->to(site_url('users'))
                ->with('error', 'Staff member not found.');
        }

        return view('users/edit', $data);
    }

    // Update a staff member
    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(site_url('users'))
                ->with('error', 'Staff member not found.');
        }

        $rules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'full_name' => 'required|min_length[2]|max_length[100]',
        ];

        $newUsername = $this->request->getPost('username');

        if ($newUsername !== $user['username']) {
            $rules['username'] .= '|is_unique[users.username]';
        }

        $newPassword = $this->request->getPost('password');

        if ($newPassword !== '') {
            $rules['password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'username' => $newUsername,
            'full_name' => $this->request->getPost('full_name'),
        ];

        // Only replace the password when a new one is provided
        if ($newPassword !== '') {
            $updateData['password'] = password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/avatars/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $avatarName = $avatar->getRandomName();
            $avatar->move($uploadPath, $avatarName);

            $updateData['avatar'] = $avatarName;
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff member updated successfully.');
    }

    // Delete a staff member
    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to(site_url('users'))
                ->with('error', 'Staff member not found.');
        }

        $this->userModel->delete($id);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff member deleted successfully.');
    }
}
