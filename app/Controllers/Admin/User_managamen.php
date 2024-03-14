<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Password;

class User_managamen extends BaseController

{

    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }
    public function index()
    {
        $data['title'] = 'User Managamen';
        $this->builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active, password_hash');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        $data['users'] = $query->getResult();

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Admin/User_managamen', $data);
        echo view('Template/Footer');
    }
    public function detail($id = 0)
    {
        $data['title'] = 'User Detail';
        $this->builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/user_managamen');
        }

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Admin/Detail', $data);
        echo view('Template/Footer');
    }
    public function edit($id = 0)
    {
        $data['title'] = 'Edit User';
        // Adjust select to match the existing columns
        $this->builder->select('users.id as userid, username, email, fullname, user_image, created_at, active, auth_groups.name as role');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        $postData = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'active' => $this->request->getPost('active'),
        ];

        // Check if password is provided and not empty
        $passwordInput = $this->request->getPost('password_hash');
        if (!empty($passwordInput)) {
            // Hash the password using Myth/Auth's Password class
            $hashedPassword = Password::hash((string) $passwordInput);
            $postData['password_hash'] = $hashedPassword;
        }

        // Retrieve the username from the query result
        $username = $data['user']->username;

        // Perform the update for other fields in the users table
        $this->builder->where('id', $id);
        $this->builder->update($postData);

        // Set flash data message with the username of the edited user
        session()->setFlashdata('pesan', "Data user dengan username $username berhasil diubah");

        return redirect()->to('/user_managamen');
    }


    public function delete($id = 0)
    {

        $this->builder->where('id', $id);
        $this->builder->delete();

        return redirect()->to('/user_managamen');
    }

    public function add()
{
    $data['title'] = 'Add User';
    $this->builder->select('name');
    $query = $this->db->table('auth_groups')->get();
    $data['groups'] = $query->getResult();

    // Validate form input
    $validationRules = [
        'username' => 'required|min_length[5]|max_length[255]|is_unique[users.username]',
        'fullname' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]', // Add more complex validation if necessary
        'active' => 'required|in_list[0,1]',
    ];

    if (!$this->validate($validationRules)) {
        // If validation fails, return to the form with errors
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Hash the password
    $passwordInput = $this->request->getPost('password');
    $hashedPassword = is_string($passwordInput) ? password_hash($passwordInput, PASSWORD_DEFAULT) : '';

    // Prepare data for insertion
    $userData = [
        'username' => $this->request->getPost('username'),
        'fullname' => $this->request->getPost('fullname'),
        'email' => $this->request->getPost('email'),
        'password_hash' => $hashedPassword,
        'active' => $this->request->getPost('active'),
    ];

    // Insert the user data
    $this->builder->insert($userData);

    // Set flash message for success
    session()->setFlashdata('pesan', 'Data user berhasil ditambahkan');

    return redirect()->to('/user_management');
}

}
