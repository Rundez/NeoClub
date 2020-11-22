<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ActivityModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Model;

class Activities extends Controller
{
    // Fetches upcoming activities
    public function index()
    {
        $model = new ActivityModel();

        $data = [
            'title' => 'Upcoming activities',
            'activities' => $model->getUpcomingActivities()
        ];

        echo view('templates/header', $data);
        echo view('activities/upcomingActivities');
        echo view('templates/footer');
    }

    // Fetches previous and upcoming acitivites
    public function allActivities()
    {
        $model = new ActivityModel();

        $data = [
            'title' => 'All activities',
            'activities' => $model->getActivities()
        ];

        echo view('templates/header', $data);
        echo view('activities/upcomingActivities');
        echo view('templates/footer');
    }

    public function view($slug = null)
    {
        $model = new ActivityModel();
        $data = [
            'activity' => $model->getActivities($slug),
        ];


        if (empty($data['activity'])) {
            throw new PageNotFoundException('Cannot find the user ' . $slug);
        }

        echo view('templates/header', $data);
        echo view('activities/selectedActivity', $data);
        echo view('templates/footer', $data);
    }


    public function add()
    {
        $name = $this->request->getVar('name');
        $activity = $this->request->getVar('aktivitet');
        $start = $this->request->getVar('start');
        $end = $this->request->getVar('end');
        $body = $this->request->getVar('body');
        $image = $this->request->getFile('image');

        $data = [
            'name' => $name,
            'aktivitet' => $activity,
            'start' => $start,
            'end' => $end,
            'body' => $body,
        ];
        //add the file to uploads and add the name to data
        $data['image'] = $this->addFile($image);
        $model = new ActivityModel();

        if($model->save($data)) {
            return redirect()->to('/activities');
        } else {
            return redirect()->to('/users');
        }
    }

    private function addFile($image)
    {
        if ($image->isValid() && ! $image->hasMoved())
        {
            $newName = $image->getRandomName();
            $image->move('uploads', $newName);
            return $newName;
        }
        return false;
    }

}
