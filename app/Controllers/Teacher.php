<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Models\PetugasModel;
use App\Controllers\BaseController;

class Teacher extends BaseController
{
   protected $guruModel;
   public function __construct()
   {
      $this->guruModel = new GuruModel();
      $this->petugasModel = new PetugasModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {

      $data = [
         'title' => 'Teacher Management',
         'subMenuTitle' => 'Teacher Management',
         'db' =>  $this->db,
         'guru' => $this->guruModel->findAll(),
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'validation' => $this->validation,
      ];
      return view('operator/guru/index', $data);
   }

   public function add()
   {
      $data = [
         'title' => 'Add Teacher',
         'subMenuTitle' => 'Teacher Management',
         'db' =>  $this->db,
         'guru' => $this->guruModel->findAll(),
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'validation' => $this->validation
      ];
      return view('operator/guru/add_guru', $data);
   }

   public function save()
   {

      //validation include
      if (!$this->validate([
         'nip' => [
            'rules' =>   'required|trim|is_unique[tbl_guru.id]|numeric',
            'errors' => [
               'required' => 'Nomor Induk Pegawai tidak boleh kosong!',
               'is_unique' => 'Nomor Induk Pegawai sudah ada.',
               'numeric' => 'Harus berupa angka.'
            ]
         ],
         'nama' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Nama tidak boleh kosong!',
            ]
         ],
         'nohp' => [
            'rules' =>   'required|trim|numeric',
            'errors' => [
               'required' => 'No Telephone tidak boleh kosong!',
               'numeric' => 'Harus berupa angka.'
            ]
         ],
         'email' => [
            'rules' =>   'required|trim|valid_email',
            'errors' => [
               'required' => 'Email tidak boleh kosong!',
               'valid_email' => 'Harus berupa Email!'
            ]
         ],
         'username' => [
            'rules' =>   'required|trim|is_unique[tbl_guru.username]|alpha_numeric',
            'errors' => [
               'required' => 'Username tidak boleh kosong!',
               'is_unique' => 'Username sudah digunakan.',
               'alpha_numeric' => 'Harus Berupa huruf atau angka atau kombinasinya.'
            ]
         ],
         'password' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Password tidak boleh kosong!',

            ]
         ],
      ])) {
         return redirect()->to('/teachers/add')->withInput()->with('validation', $this->validation);
      }
      // dd($this->request->getVar());

      if ($this->guruModel->save([
         'nip' => $this->request->getVar('nip'),
         'username' => $this->request->getVar('username'),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
         'email' => $this->request->getVar('email'),
         'nama' => $this->request->getVar('nama'),
         'nohp' => $this->request->getVar('nohp'),
         'image' => 'default.png',
         'role_id' => 3, //guru
         'is_active' => 1
      ])) {
         session()->setFlashdata('pesan', ' Data <b>' . $this->request->getVar('nama') . '</b> berhasil dibuat');
         return redirect()->to('/teachers');
      } else {
         echo 'gagal';
      }
   }

   public function update($id = null)
   {
      if ($id) {

         $data = [
            'title' => 'Edit Teacher',
            'subMenuTitle' => 'Teacher Management',
            'db' =>  $this->db,
            'guru' => $this->guruModel->where(['id' => decrypt_url($id)])->first(),
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'validation' => $this->validation
         ];
         return view('operator/guru/edit_guru', $data);
      } else {

         $cek_username = $this->guruModel->where(['username' => $this->request->getVar('username')])->first();
         if ($cek_username) {
            $is_unique = ($cek_username['id'] === $this->request->getVar('id')) ? '' : '|is_unique[tbl_guru.username]';
            $err_is_unique = ($cek_username['id'] === $this->request->getVar('id')) ? "" :  " 'is_unique' => 'Username sudah digunakan.' ";
         } else {
            $is_unique = '';
            $err_is_unique = '';
         }
         //validation include
         if (!$this->validate([
            'nip' => [
               'rules' =>   'required|trim|is_unique[tbl_guru.id]|numeric',
               'errors' => [
                  'required' => 'Nomor Induk Pegawai tidak boleh kosong!',
                  'is_unique' => 'Nomor Induk Pegawai sudah ada.',
                  'numeric' => 'Harus berupa angka.'
               ]
            ],
            'nama' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Nama tidak boleh kosong!',
               ]
            ],
            'nohp' => [
               'rules' =>   'required|trim|numeric',
               'errors' => [
                  'required' => 'No Telephone tidak boleh kosong!',
                  'numeric' => 'Harus berupa angka.'
               ]
            ],
            'email' => [
               'rules' =>   'required|trim|valid_email',
               'errors' => [
                  'required' => 'Email tidak boleh kosong!',
                  'valid_email' => 'Harus berupa Email!'
               ]
            ],
            'username' => [
               'rules' =>   'required|trim' . $is_unique . '|alpha_numeric',
               'errors' => [
                  'required' => 'Username tidak boleh kosong!',
                  $err_is_unique,
                  'alpha_numeric' => 'Harus Berupa huruf atau angka atau kombinasinya.'

               ]
            ],
         ])) {
            return redirect()->to('/teachers/' . encrypt_url($this->request->getVar('id')) . '/edit')->withInput()->with('validation', $this->validation);
         }

         $is_active  = ($this->request->getVar('is_active')) ? 1 : 0;

         if ($this->guruModel->save([
            'id' => $this->request->getVar('id'),
            'nip' => $this->request->getVar('nip'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'nama' => $this->request->getVar('nama'),
            'nohp' => $this->request->getVar('nohp'),
            'image' => 'default.png',
            'role_id' => 3, //guru
            'is_active' => $is_active
         ])) {
            session()->setFlashdata('pesan', ' Data <b>' . $this->request->getVar('nama') . '</b> berhasil diUpdate');
            return redirect()->to('/teachers');
         } else {
            echo 'gagal';
         }
      }
   }

   public function changepassword()
   {
      if ($this->guruModel->save([
         'id' => $this->request->getVar('id'),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
      ])) {
         session()->setFlashdata('pesan', ' Password <b>' . $this->request->getVar('nama') . '</b> berhasil diUpdate (Pass : ' . $this->request->getVar('password') . ')');
         return redirect()->to('/teachers');
      } else {
         echo 'gagal';
      }
   }

   public function delete()
   {

      if ($this->guruModel->delete(['id', $this->request->getVar('id')])) {
         session()->setFlashdata('pesan', 'Data <b>' . $this->request->getVar('nama') . '</b>  berhasil di delete');
         return redirect()->to('/teachers');
      } else {
         echo 'gagal';
      }
   }

   //--------------------------------------------------------------------

}
