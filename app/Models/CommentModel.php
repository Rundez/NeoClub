<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $allowedFields = ['message', 'postID', 'senderID'];

    /**
     * Returns an array of comments to a chosen post
     */
    public function getCommentsForPost($postID)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);
        
        $builder->select(
        'comments.message, comments.postID, comments.senderID, 
        users.firstName, users.lastName'
        );
        
        $builder->join('posts', 'posts.id = comments.postID');
        $builder->join( 'users', 'users.id = comments.senderID');
        $builder->where('postID', $postID);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
