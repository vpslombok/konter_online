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
}
