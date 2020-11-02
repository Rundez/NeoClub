<?php 

namespace App\Controllers;
use CodeIgniter\Controller;


class Home extends BaseController
{
	public function index()
	{
		echo view('templates/header');
		echo view('index');
		echo view('templates/footer');
	}

	//--------------------------------------------------------------------

}
