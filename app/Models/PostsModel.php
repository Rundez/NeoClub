<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $allowedFields = ['creator', 'title', 'body', 'id', 'created'];

    /**
     * Returns an array with all the posts in the db
     */
    public function getPosts()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        $builder->select(
        'posts.creator, posts.title, posts.body, posts.id as postID, users.firstName, users.lastName,
        users.slug, users.role, users.id');
        $builder->join('users', 'posts.creator = users.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
