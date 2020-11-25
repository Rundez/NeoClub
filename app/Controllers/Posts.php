<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\Controller;

class Posts extends Controller
{
    public function index()
    {
        $model = new PostsModel();

        // fetch data from DB. Reverse the array.
        $data = [
            'posts' => array_reverse($model->getPosts(), true),
            'title' => 'The wall',
        ];


        echo view('templates/header', $data);
        echo view('posts/wall');
        echo view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = new PostsModel();

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

    public function newPost()
    {

        $data = [
            'title' => $this->request->getVar('title'),
            'body' => $this->request->getVar('body'),
            'creator' => session()->get('id')
        ];

        // Authenticate if user is logged in
        if (session()->get('isLoggedIn') != 1) {
            session()->setflashdata('error', 'You have to be logged in to use this feature!');
            return redirect()->to('/posts');
        }

        $model = new PostsModel();
        if($model->insert($data)) {
            return redirect()->to('/posts');
        }
    }
}
