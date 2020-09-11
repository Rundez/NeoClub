<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Users extends Controller
{
    public function index()
    {
        $model = new UsersModel();

        $data = [
            'users' => $model->getUsers(),
            'title' => 'All users',
        ];

        echo view('templates/header', $data);
        echo view('users/useroverview', $data);
        echo view('templates/footer', $data);
    }

    public function view($slug = null)
    {
        $model = new UsersModel();

        $data = [
           'user' => $model->getUsers($slug),
           'title' => 'User'
        ];

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user ' . $slug);
        }

        echo view('templates/header', $data);
        echo view('users/selectedUser', $data);
        echo view('templates/footer', $data);
    }
}
