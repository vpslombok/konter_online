<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = 'COUNTER | ONLINE';

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Dashboard');
        echo view('Template/Footer');
    }

    public function profile_setting()
    {
        $data['title'] = 'Profile Setting';

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Profile_Setting', $data);
        echo view('Template/Footer');
    }

    public function my_profile()
    {
        $data['title'] = 'My Profile';

        // Mengambil informasi sesi pengguna dengan Myth/Auth
        $auth = service('authentication');
        $data['user'] = $auth->user();

        // Jika pengguna tidak terautentikasi, arahkan ke halaman dashboard
        if (!$data['user']) {
            return redirect()->to('/dashboard');
        }

        // Mengambil informasi tambahan dari tabel 'users' dan 'auth_groups'
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->where('users.id', $data['user']->id);
        $query = $builder->get();
        $data['profile'] = $query->getRow();

        // Jika data profil tidak ditemukan, arahkan ke halaman dashboard
        if (empty($data['profile'])) {
            return redirect()->to('/dashboard');
        }

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('My_profile', $data);
        echo view('Template/Footer');
    }
}
