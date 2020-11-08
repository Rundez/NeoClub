<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Velkommen til admin'
        ];

        echo view('templates/header');
        echo view('admin/admin', $data);
        echo view('templates/footer');
    }


}