<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
 
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
    }


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
        $data['validation'] = \Config\Services::validation();

        // Mengambil informasi sesi pengguna dengan Myth/Auth
        $auth = service('authentication');
        $data['user'] = $auth->user();

        // Jika pengguna tidak terautentikasi, arahkan ke halaman dashboard
        if (!$data['user']) {
            return redirect()->to('/dashboard');
        }

        // Mengambil informasi tambahan dari tabel 'users' dan 'auth_groups'
       
        $this->builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $data['user']->id);
        $query = $this->builder->get();
        $data['profile'] = $query->getRow();

        // Jika data profil tidak ditemukan, arahkan ke halaman dashboard
        if (empty($data['profile'])) {
            return redirect()->to('/dashboard');
        }

        //insert data to database
        if ($this->request->getMethod() === 'post'){
            $rules = [
                'fullname' => 'required|min_length[3]',
                'user_image' => [
                    'uploaded[user_image]',
                    'mime_in[user_image,image/jpg,image/jpeg,image/png]',
                    'max_size[user_image,1024]',
                ],
            ];

            if ($this->validate($rules)) {
                $fileUserImage = $this->request->getFile('user_image');

                // Generate nama file acak
                $newFileName = $fileUserImage->getRandomName();

                $fileUserImage->move('assets/img', $newFileName);

                // Simpan nama file foto profil lama
                $oldImage = $data['profile']->user_image;

               
                $this->builder->where('id', $data['user']->id);
                $this->builder->update([
                    'fullname' => $this->request->getPost('fullname'),
                    'user_image' => $newFileName,
                ]);

                // Hapus foto profil lama, kecuali jika itu adalah file default.svg
                if ($oldImage && $oldImage !== 'default.svg' && file_exists('assets/img/' . $oldImage)) {
                    unlink('assets/img/' . $oldImage);
                }

                session()->setFlashdata('message', 'Profile has been updated');
                return redirect()->to('/profile_setting');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        echo view('Template/Header', $data);
        echo view('Template/Sidebar', $data);
        echo view('Profile_Setting', $data);
        echo view('Template/Footer', $data);
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
        $this->builder->select('users.id as userid, username, email, name, fullname, user_image, created_at, active');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $data['user']->id);
        $query = $this->builder->get();
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
