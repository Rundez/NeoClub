<?php

namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class RestChat extends ResourceController
{
    use ResponseTrait;

    // all messages
    public function index()
    {
        $model = new ChatModel();
        $data['chat'] = $model->orderBy('sender', 'DESC')->fetch();
        return $this->respond($data);
    }

    // adds a new message
    public function create()
    {
        $model = new ChatModel();
        $data = $this->request->getJSON(true);
        
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Chat sent successfully'
            ]
        ];
        return $this->respondCreated($response);
    }

    // get chats from single user
    public function show($id = null){
        $model = new ChatModel();
        $data = $model->where('sender', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No chat found from user');
        }
    }
}
