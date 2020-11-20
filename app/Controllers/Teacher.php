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
         'validation' => $this->validation
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

   // public function update()
   // {
   //    //validation include
   //    if (!$this->validate([
   //       'role' => [
   //          'rules' =>   'required|trim|is_unique[tbl_user_role.role]|alpha_space|max_length[128]',
   //          'errors' => [
   //             'required' => 'User role tidak boleh kosong!',
   //             'is_unique' => 'User role sudah ada.'
   //          ]
   //       ]
   //    ])) {
   //       return redirect()->to('/users')->withInput()->with('validation', $this->validation);
   //    }


   //    if ($this->roleModel->save([
   //       'id' => $this->request->getVar('role_id'),
   //       'role' => $this->request->getVar('role')
   //    ])) {
   //       session()->setFlashdata('pesan', 'Role user role <b>' . $this->request->getVar('role') . '</b> berhasil diupdate');
   //       return redirect()->to('/users');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

   // public function delete()
   // {

   //    if ($this->roleModel->delete(['id', $this->request->getVar('role_id')])) {
   //       session()->setFlashdata('pesan', 'Berhasil di delete');
   //       return redirect()->to('/users');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

   //--------------------------------------------------------------------

}
