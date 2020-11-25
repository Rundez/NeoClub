<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'Activities';
    protected $allowedFields = ['name', 'aktivitet', 'start', 'end', 'body', 'created', 'image'];

    // Fetches all the activities if no parameter is given.
    public function getActivities($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['slug' => $slug])
            ->first();
    }

    // Fetches all activities from today and in the future
    public function getUpcomingActivities() 
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select("*");
        $builder->where("start >= DATE(NOW())");
        
        return $builder->get()->getResultArray();
    }
}