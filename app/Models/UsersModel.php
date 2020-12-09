<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'firstName', 'lastName', 'slug', 'email', 'created', 'password', 'kontigentstatus', 'role', 'address', 'postalcode', 'posttown','phone', 'gender'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];


    public function getUsers($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['slug' => $slug])
            ->first();
    }

    public function updateProfile($id, $data)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('users');

        $builder->where('id', $id);
        $builder->update($data);
    }

    /**
     * A function that will execute with every insert statement.
     */
    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    /**
     * A function that will execute with every update statement.
     */
    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    /**
     * Hashes the password before insert/update.
     */
    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            return $data;
        }
    }


}
