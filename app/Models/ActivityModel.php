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
}
