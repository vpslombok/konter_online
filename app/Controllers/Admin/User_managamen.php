<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
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
    public function edit($id)
    {
       $this->builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();
        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/user_managamen');
        }

        $data = [
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'active' => $this->request->getVar('active'),
        ];

        if (!empty($this->request->getVar('password_hash'))) {
            $data['password_hash'] = Password::hash($this->request->getVar('password_hash'));
        }

        $this->builder->where('id', $id);
        $this->builder->update($data);

        $username = $data['username'];

        // Set flash message for success
        session()->setFlashdata('pesan', "Data $username berhasil diubah");
        return redirect()->to('/user_managamen');
    }



    public function delete($id = 0)
    {

        $this->builder->where('id', $id);
        $this->builder->delete();

        // Set flash message for success
        session()->setFlashdata('pesan', "Data berhasil dihapus");
        return redirect()->to('/user_managamen');
    }

    public function add()
    {

        $user_myth = new UserModel();
        $user_myth->withGroup($this->request->getVar('role'))->save([
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'password_hash' => Password::hash($this->request->getVar('password_hash')),
            'active' => $this->request->getVar('active'),
        ]);


        // Set flash message for success
        session()->setFlashdata('pesan', 'Data user berhasil ditambahkan');
        return redirect()->to('/user_managamen');
    }
}
