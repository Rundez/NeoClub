<?php

namespace App\Controllers;

use App\Models\HobbyModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends Controller
{
    public function index()
    {
        $model = new UsersModel();
        $hobbies = new HobbyModel();

        $data = [
            'users' => $model->getUsers(),
            'title' => 'Neo ungdomsklubb medlemmer',
        ];

        $allHobbies = array_map(fn($user) => $hobbies->getUserHobbies($user['id']), $data['users']);

        // Dette MÅ fikses....
        for($i = 0; $i < count($data['users']); $i++) {
            $data['users'][$i]['hobbies'] = $allHobbies[$i] ? $allHobbies[$i] : "Ingen data";
        }
        
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

    public function login()
    {
        new UsersModel();

        $data = [];
        //Helper class that takes care of validation data 
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //Validation
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|validateUser[email, password]',
                'password' => 'required|min_length[6]|max_length[255]',
            ];

            //Custom error message
            $errors = [
                'password' => [
                    'validateUser' => 'Email or password don\'t match'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UsersModel();
                $user = $model->where('email', $this->request->getVar('email'))->first();


                $this->setUserSession($user);
                $session = session();
                $session->setFlashdata('success', 'Successful login');

                return redirect()->to('/posts');
            }
        }

        echo view('templates/header', $data);
        echo view('users/login');
        echo view('templates/footer');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstName'],
            'lastname' => $user['lastName'],
            'email' => $user['email'],
            'isLoggedIn' => true
        ];

        session()->set($data);
        return true;
    }

    public function register()
    {

        $data = [];
        //Helper class that takes care of validation data 
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //Validation
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
                'password_confirm' => 'matches[password]'
            ];

            if (!$this->validate($rules)) {
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


    public function logout()
    {
        if(session()->get('isLoggedIn')) {
            session()->remove('isLoggedIn');
        }

        return redirect()->to('/');
    }

    public function profile()
    {
        $data = [
            'firstname' => session()->get('firstname'),
            'lastname' => session()->get('lastname'),
        ];

        echo view('templates/header', $data);
        echo view('users/profile');
        echo view('templates/footer');

    }

    public function addProfilePic() 
    {
        $image = $this->request->getFile('image');

        // Checks the size and type if the file
        if($image->getSizeByUnit('mb') <= 2 && (strpos($image->guessExtension(), 'jpg') !== false) || strpos($image->guessExtension(), 'png') !== false) {
            $image->move('uploads', session()->get('id'));
            return redirect()->to("/profile");
        } else {
            $session = session();
            $session->setFlashdata('error', 'Please select a .jpg or .png smaller then 2mb');

            return redirect()->to("/profile");
        }
    }

    public function edit() 
    {
        $data = [

        ];

        echo "Hello";
        echo view('templates/header', $data);
        echo view('users/editProfile');
        echo view('templates/footer');

    }
}
