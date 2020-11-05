<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends Controller
{
    public function index()
    {
        $model = new UsersModel();

        $data = [
            'users' => $model->getUsers(),
            'title' => 'Neo ungdomsklubb medlemmer',
        ];

        echo view('templates/header', $data);
        echo view('users/useroverview', $data);
        echo view('templates/footer', $data);
    }

    public function view($slug = null)
    {
        $model = new UsersModel();

        $data = [
           'user' => $model->getUsers($slug),
           'title' => 'User'
        ];

        if (empty($data['user'])) {
            throw new PageNotFoundException('Cannot find the user ' . $slug);
        }

        echo view('templates/header', $data);
        echo view('users/selectedUser', $data);
        echo view('templates/footer', $data);
    }

    public function login(){
        new UsersModel();

        $data = [];
        //Helper class that takes care of validation data 
        helper(['form']);

        if($this->request->getMethod() == 'post'){
            //Validation
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|validateUser[email,password]',
                'password' => 'required|min_length[6]|max_length[255]',
                
            ];

            //Custom error message
            $errors = [
                'password' => [
                    'validateUser' => 'Email or password don\'t match'
                ]
            ];

            if(! $this->validate($rules, $errors)){
                $data['validation'] = $this->validator;
            } else {
                //Store the user in the db 
                $model = new UsersModel();
                
                //$newData = [
                //    'firstName' => $this->request->getVar('firstname'),
                //    'lastName' => $this->request->getVar('lastname'),
                //    'email' => $this->request->getVar('email'),
                //    'password' => $this->request->getVar('password')
                //];

                //$model->save($newData);
                //$session = session();
                //$session->setFlashdata('success', 'Successful registration');
                //return redirect()->to('/login');
            }

        } 

        echo view('templates/header', $data);
        echo view('users/login');
        echo view('templates/footer');
    }

    public function register(){

        $data = [];
        //Helper class that takes care of validation data 
        helper(['form']);

        if($this->request->getMethod() == 'post'){
            //Validation
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if(! $this->validate($rules)){
                $data['validation'] = $this->validator;
            } else {
                //Store the user in the db 
                $model = new UsersModel();
                
                $newData = [
                    'firstName' => $this->request->getVar('firstname'),
                    'lastName' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password')
                ];

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful registration');
                return redirect()->to('/login');
            }

        } 

        echo view('templates/header');
        echo view('users/register', $data);
        echo view('templates/footer');
    }

    public function edit(){
        $model = new UsersModel();

        $data = [];
        //Helper class that takes care of validation data 
        helper(['form']);

        echo view('templates/header');
        echo view('users/login');
        echo view('templates/footer');
    }
}
