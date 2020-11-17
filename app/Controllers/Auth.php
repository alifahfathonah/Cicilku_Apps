<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PetugasModel;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
	protected $userModel;
	protected $petugasModel;
	protected $guruModel;
	protected $siswaModel;
	public function __construct()
	{
		$this->userModel = new UserModel();
		$this->petugasModel = new PetugasModel();
		$this->guruModel = new GuruModel();
		$this->siswaModel = new SiswaModel();
		$this->validation = \Config\Services::validation();
		$this->db = \Config\Database::connect();
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
			'username' => 'required|trim',
			'password' => 'required|trim'
		])) {

			return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
		}

		//get form login
		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		//count user role
		$count = $this->db->table('tbl_user_role')->countAll();

		//check username 4 table users(petugas,guru,siswa,user)
		$userModel = [
			'1' => $this->guruModel->where(['username' => $username])->orWhere(['id' => $username])->first(),
			'2' => $this->userModel->where(['username' => $username])->first(),
			'3' => $this->siswaModel->where(['username' => $username])->orWhere(['id' => $username])->first(),
			'4' => $this->petugasModel->where(['username' => $username])->orWhere(['id' => $username])->first(),
		];

		for ($i = 1; $i <= $count; $i++) {
			if ($userModel[$i]) {
				$is_active_cek = $userModel[$i]['is_active'];
				$username_cek = $userModel[$i]['username'];
				$password_cek = $userModel[$i]['password'];
				$role_id_cek = $userModel[$i]['role_id'];
				$id_cek = $userModel[$i]['id'];
				break;
			}
		}


		if (!empty($username_cek)) {
			//user active check
			if ($is_active_cek == 1) {

				//password verify 
				if (password_verify($password, $password_cek)) {

					//session set
					$data = [
						'id_user' => $id_cek,
						'username' => $username_cek,
						'role_id' => $role_id_cek,
						'admin_unlock' => 0

					];
					session()->set($data);

					//role id 1 = admin, 2 = kepsek, 3 = guru_kelas, 4 = petugas, 5 = siswa
					if ($role_id_cek == 1) {
						return redirect()->to('/admin');
					} else {
						return redirect()->to('/');
					}
				} else {
					session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
				}
			} else {
				session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">This Account has not been activated!</div>');
				return redirect()->to('/auth')->withInput()->with('validation', $this->validation);
			}
		} else {
			session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Username or ID is not registration</div>');
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
		session()->remove(['username', 'role_id', 'id_user', 'admin_unlock']);
		session()->setFlashdata('pesan', '<div class="alert alert-success" role="alert">Your have been logged out</div>');
		return redirect()->to('/auth');
	}
	//--------------------------------------------------------------------

}
