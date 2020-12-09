<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use Config\Services;

class Admin extends Controller
{
    /**
     * Index method that returns the main admin panel
     */
    public function index()
    {
        $data = [
            'title' => 'Admin Dashboard'
        ];

        echo view('templates/header');
        echo view('admin/admin', $data);
        echo view('templates/footer');
    }

    /**
     * Function that verifies the incoming data and returns the user back
     * to the same page.
     */
    public function editUser()
    {
        // Loading the form helper to verify input
        helper(['form']);

        $data = [];
        //Validation
        $rules = [
            'firstname' => 'required|min_length[3]|max_length[20]',
            'lastname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'address' => 'required',
            'postalcode' => 'required|min_length[4]|max_length[4]',
            'posttown' => 'required',
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            $slug = $this->request->getVar('slug');

            session()->setFlashdata('error', $data['validation']->listErrors());

            return redirect()->to(site_url(['users', $slug]));
        } else {
            //Store the user in the db 
            $model = new UsersModel();

            $data = [
                'firstName' => $this->request->getVar('firstname'),
                'lastName' => $this->request->getVar('lastname'),
                'email' => $this->request->getVar('email'),
                'address' => $this->request->getVar('address'),
                'postalcode' => $this->request->getVar('postalcode'),
                'posttown' => $this->request->getVar('posttown'),
            ];

            $slug = $this->request->getVar('slug');
            $id = $this->request->getVar('id');

            $model->updateProfile($id, $data);

            session()->setFlashdata('success', 'Successful edit');
            return redirect()->to("http://localhost:8080/users/${slug}");
        }
    }

    /**
     * Sends a invoice to the selected user. Only allowed by admins. 
     * Mailtrap is used for testing.
     */
    function sendEmail($emailTo)
    {
        $email = Services::email();

        $email->setFrom('4f8c9e946b-3e0e1c@inbox.mailtrap.io', 'Neo Club');
        $email->setTo($emailTo);
        $email->setSubject('Membership payment');
        $email->setMessage('Please pay for your membership');
        $email->send();
        session()->setFlashdata('success', 'Invoice sent successfully');
        return redirect()->to($_SERVER['HTTP_REFERER']);
    }
}
   
