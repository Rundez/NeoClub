<?php

namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\Controller;


class Chat extends Controller
{
    /**
     * Returns the chat view. All chats are loaded from the REST controller.
     */
    public function index()
    {
        $model = new ChatModel();

        //$data = [
        //    'posts' => $model->getPosts(),
        //    'title' => 'All posts',
        //];

        echo view('templates/header');
        echo view('chat/chat');
        echo view('templates/footer');
    }    
}
