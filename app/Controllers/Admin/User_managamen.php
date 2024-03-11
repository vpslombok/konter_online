<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class User_managamen extends BaseController
{
    public function index()
    {
        $data['title'] = 'User Managamen';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();
        $data['users'] = $query->getResult();

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Admin/User_managamen', $data);
        echo view('Template/Footer');
    }
    public function detail($id = 0)
    {
        $data['title'] = 'User Detail';
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->where('users.id', $id);
        $query = $builder->get();
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
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('id', $id);
        $builder->update($_POST);

        return redirect()->to('/user_managamen');
    }
    public function delete($id = 0)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('id', $id);
        $builder->delete();

        return redirect()->to('/user_managamen');
    }

    public function add()
{
    $data['title'] = 'Add User';

    // Load the groups from the auth_groups table
    $db = \Config\Database::connect();
    $builder = $db->table('auth_groups');
    $builder->select('id, name');
    $query = $builder->get();
    $data['groups'] = $query->getResult();

    // Validate and sanitize user input
    $validation = \Config\Services::validation();
    $validationRules = [
        'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]',
        'name' => 'required'
    ];

    if (!$this->validate($validationRules)) {
        return redirect()->to('/user_managamen')->withInput()->with('validation', $validation);
    }

    // Insert user data into the users table
    $users = new \Myth\Auth\Models\UserModel();
    $data = [
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'password' => $this->request->getPost('password'),
        'name' => $this->request->getPost('name'),
        'user_image' => 'default.jpg',
        'active' => 1
    ];
    $users->save($data);

    // Get the user ID of the newly created user
    $user = $users->where('email', $this->request->getPost('email'))->first();

    // Add the user to the selected group
    $group = $this->request->getPost('group');
    $users->addUserToGroup($user->id, $group);

    // Redirect to the user management page
    return redirect()->to('/user_managamen');
}

}
