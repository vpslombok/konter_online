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
        $builder->select('users.id as userid, username, email, name, fullname, user_image');
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

}