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

   // public function save()
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
   //       'role' => $this->request->getVar('role')
   //    ])) {
   //       session()->setFlashdata('pesan', 'Role user <b>' . $this->request->getVar('menu') . '</b> berhasil dibuat');
   //       return redirect()->to('/users');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

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
