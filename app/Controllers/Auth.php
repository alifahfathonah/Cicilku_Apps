<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
	protected $userModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->validation = \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'title' => 'Masuk ke Cicilku',
			'validation' => $this->validation
		];
		return view('auth/login', $data);
	}

	/* fungsi login
	| pengelolahaan data user untuk login
	*/
	public function login()
	{
		if (!$this->validate([
			'email' => 'required|trim|valid_email',
			'password' => 'required|trim'
		])) {

			return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
		}

		//get form login
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');


		//user check in database
		$user = $this->userModel->where(['email' => $email])->first();


		if ($user) {
			//user active check
			if ($user['is_active'] == 1) {

				//password verify 
				if (password_verify($password, $user['password'])) {

					//session set
					$data = [
						'id_user' => $user['id'],
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'admin_unlock' => 0

					];
					session()->set($data);

					//role id 1 = admin, 2 = kepsek, 3 = guru_kelas, 4 = petugas, 5 = siswa
					if ($user['role_id'] == 1) {
						return redirect()->to('/admin');
					} else {
						return redirect()->to('/my');
					}
				} else {
					session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
				}
			} else {
				session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">This Email has not been activated!</div>');
				return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
			}
		} else {
			session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Email is not registration</div>');
			return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
		}
	}

	public function register()
	{

		$data = [
			'title' => 'Masuk ke Cicilku',
			'validation' => \Config\Services::validation()
		];
		return view('auth/register', $data);
	}

	/* fungsi save
	| pengelolahaan data di registrasi Untuk di Insert ke dalam Tabel
	*/
	public function save()
	{

		//validation include
		if (!$this->validate([
			'name' => [
				'rules' =>   'required|trim|is_unique[tbl_user.name]|alpha_space|min_length[3]|max_length[128]',
				'errors' => [
					'is_unique' => 'This username has already registered.'
				]
			],
			'email' => 'required|valid_email',
			'password' => 'required|min_length[8]|matches[password-repeat]',
			'password-repeat' => 'required|min_length[8]|matches[password]'
		])) {
			return redirect()->to('/register')->withInput()->with('validation', $this->validation);
		}


		$this->userModel->save([
			'name' => $this->request->getVar('name'),
			'email' => $this->request->getVar('email'),
			'image' => 'default.png',
			'password' => password_hash($this->request->getVar('password-repeat'), PASSWORD_DEFAULT),
			'role_id' => 1, //default administrator
			'is_active' => 1
		]);

		session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please Login</div>');
		return redirect()->to('/auth');
	}

	public function logout()
	{
		session_destroy();
		session()->remove(['email', 'role_id', 'id_user']);
		session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">Your have been logged out</div>');
		return redirect()->to('/auth');
	}
	//--------------------------------------------------------------------

}
