<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $allowedFields = ['creator', 'title', 'body'];

    public function getPosts()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        $builder->select('*');
        $builder->join('users', 'posts.creator = users.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
