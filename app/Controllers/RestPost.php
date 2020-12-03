<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class RestPost extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\PostsModel';
    protected $format = 'json';

    // all posts
    public function index()
    {
        $model = new PostsModel();

        return $this->respond($model->getPosts());
    }

    // adds a new message
    public function create()
    {
        $model = new PostsModel();
        $data = $this->request->getJSON(true);
        
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Post successfully added'
            ]
        ];
        return $this->respondCreated($response);
    }

    // get chats from single user
    public function show($id = null){
        $model = new PostsModel();
        $data = $model->where('sender', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No chat found from user');
        }
    }
}
