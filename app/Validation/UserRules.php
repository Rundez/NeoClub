<?php 
namespace App\Validation;
use App\Models\UsersModel;

class UserRules {

    public function validateUser(string $str, string $fields, array $data){
        $model = new UsersModel();

        // Checks if a user with that email exists 
        $user = $model->where('email', $data['email'])->first();

        if(!$user) 
            return false;

        //Returns true if the input password matches the existing
        return password_verify($data['password'], $user['password']);
    }
}
