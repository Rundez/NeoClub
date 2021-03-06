<?php

namespace App\Controllers;

use App\Models\HobbyModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * A class that handles most of the user-related actions.
 */
class Users extends Controller
{
    /**
     * Returns an overview of all users in the database. 
     */
    public function index()
    {
        $model = new UsersModel();
        $hobbies = new HobbyModel();

        $data = [
            'users' => $model->getUsers(),
            'title' => 'Neo Club Members',
        ];

        // Fetch hobbies for each user
        $allHobbies = array_map(fn($user) => $hobbies->getUserHobbies($user['id']), $data['users']);

        // This could be more elegant. Attatches an array to each user in the main data array.
        for ($i = 0; $i < count($data['users']); $i++) {
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
            'isLoggedIn' => true,
            'role' => $user['role']
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
                'phone' => 'required|min_length[8]|max_length[8]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'address' => 'required',
                'postalcode' => 'required|min_length[4]|max_length[4]',
                'posttown' => 'required',
                'gender' => 'required',
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
                    'address' => $this->request->getVar('address'),
                    'postalcode' => $this->request->getVar('postalcode'),
                    'posttown' => $this->request->getVar('posttown'),
                    'phone' => $this->request->getVar('phone'),
                    'password' => $this->request->getVar('password'),
                    'gender' => $this->request->getVar('gender'),
                ];
                
                // Not pretty, but assigns the role if given. 
                if($this->request->getVar('role') == 'admin') {
                    $newData['role'] = 'admin';
                } else {
                    $newData['role'] = 'member';
                }

                $model->save($newData);
                $slug = $model->select('id, firstName')->where('email', $this->request->getVar('email'))->first();
                $model->updateProfile($slug['id'], $data = ['slug' => $slug['firstName'] . $slug['id']]);
                $session = session();
                $session->setFlashdata('success', 'Successful registration');

                if($this->request->getVar('type') == 'admin') {
                    return redirect()->to('/admin');

                } else {
                    return redirect()->to('/login');
                }
            }
        }

        echo view('templates/header');
        echo view('users/register', $data);
        echo view('templates/footer');
    }


    public function logout()
    {
        if (session()->get('isLoggedIn')) {
            session()->destroy();
        }

        return redirect()->to('/');
    }

    public function profile()
    {
        $model = new HobbyModel();

        $data = [
            'firstname' => session()->get('firstname'),
            'lastname' => session()->get('lastname'),
            'email' => session()->get('email'),
            'hobbies' => array_map(fn($hobby) => $hobby['hobby'], $model->getUserHobbies(session()->get('id'))),
            'role' => session()->get('role'),
        ];


        echo view('templates/header', $data);
        echo view('users/profile');
        echo view('templates/footer');
    }

    public function addProfilePic()
    {
        $image = $this->request->getFile('image');

        // Checks the size and type if the file
        if ($image->getSizeByUnit('mb') <= 2 && (strpos($image->guessExtension(), 'jpg') !== false) || strpos($image->guessExtension(), 'png') !== false) {
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
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'email' => $this->request->getVar('email'),
        ];

        $model = new UsersModel();
        $model->updateProfile(session()->get('id'), $data);

        session()->setFlashdata('success', 'Profile updated. Please refresh the page to see the changes');

        return redirect()->to("/profile");
    }
}
