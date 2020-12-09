<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'message', 'sender'];


    /**
     * Returns all chats in the db
     */
    public function fetch()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('chat.sent, chat.id, chat.message, chat.sender, users.firstName, users.lastName');
        $builder->join('users', 'chat.sender = users.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
