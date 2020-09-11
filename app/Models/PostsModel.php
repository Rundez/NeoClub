<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';

    public function getPosts()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        $builder->select('*');
        $builder->join('users', 'posts.id = users.id');
        $query = $builder->get();
        $rows = $query->getResultArray();

        return $rows;
    }
}
