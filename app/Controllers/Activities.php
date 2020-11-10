<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ActivityModel;
use CodeIgniter\Model;

class Activities extends Controller
{
    public function index()
    {
        $model = new ActivityModel();

        $data = [
            'title' => 'Upcoming activities',
            'activities' => $model->getActivities()
        ];

        echo view('templates/header', $data);
        echo view('activities/allActivities');
        echo view('templates/footer');
    }

    public function view($page = 'home')
    {


    }

    public function add()
    {
        $name = $this->request->getVar('name');
        $activity = $this->request->getVar('aktivitet');
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $body = $this->request->getVar('body');

        $data = [
            'name' => $name,
            'aktivitet' => $activity,
            'start' => $start,
            'end' => $end,
            'body' => $body,
        ];

        $model = new ActivityModel();

        if($model->save($data)) {
            return redirect()->to('/activities');
        } else {
            return redirect()->to('/users');
        }
    }

}
