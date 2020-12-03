<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class RestActivities extends ResourceController
{
    use ResponseTrait;
    protected $modelName = 'App\Models\ActivityModel';
    protected $format = 'json';

    // return all activities
    public function index()
    {
        $model = new ActivityModel();

        return $this->respond($model->getActivities());
    }

    // adds a new message
    public function create()
    {
        $model = new ActivityModel();
        $data = $this->request->getJSON(true);
        
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Activity successfully added'
            ]
        ];
        return $this->respondCreated($response);
    }
}
