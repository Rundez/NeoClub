<?php

namespace App\Models;

use CodeIgniter\Model;

class HobbyModel extends Model
{
    protected $table = 'userhobbies';
    protected $allowedFields = ['userID', 'hobby'];

    // Fetches all hobbies associated with the user 
    public function getUserHobbies($userID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select("hobby");
        $builder->where("userhobbies.userID = $userID");
        
        return $builder->get()->getResultArray();
    }

}
