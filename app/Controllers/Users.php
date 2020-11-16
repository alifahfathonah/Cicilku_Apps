<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\SubMenuModel;
use App\Models\RoleModel;
use App\Controllers\BaseController;

class Users extends BaseController
{
   protected $userModel;
   protected $menuModel;
   protected $roleModel;
   protected $subMenuModel;
   public function __construct()
   {
      $this->userModel = new UserModel();
      $this->menuModel = new MenuModel();
      $this->roleModel = new RoleModel();
      $this->subMenuModel = new SubMenuModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {

      $data = [
         'title' => 'Users Management',
         'subMenuTitle' => 'Users Management',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'role' => $this->roleModel->findAll(),
         'validation' => $this->validation
      ];
      return view('admin/users/index', $data);
   }

   public function save()
   {
      //validation include
      if (!$this->validate([
         'role' => [
            'rules' =>   'required|trim|is_unique[tbl_user_role.role]|alpha_space|max_length[128]',
            'errors' => [
               'required' => 'User role tidak boleh kosong!',
               'is_unique' => 'User role sudah ada.'
            ]
         ]
      ])) {
         return redirect()->to('/admin/users')->withInput()->with('validation', $this->validation);
      }


      if ($this->roleModel->save([
         'role' => $this->request->getVar('role')
      ])) {
         session()->setFlashdata('pesan', 'Role user <b>' . $this->request->getVar('menu') . '</b> berhasil dibuat');
         return redirect()->to('/admin/users');
      } else {
         echo 'gagal';
      }
   }

   public function update()
   {
      //validation include
      if (!$this->validate([
         'role' => [
            'rules' =>   'required|trim|is_unique[tbl_user_role.role]|alpha_space|max_length[128]',
            'errors' => [
               'required' => 'User role tidak boleh kosong!',
               'is_unique' => 'User role sudah ada.'
            ]
         ]
      ])) {
         return redirect()->to('/admin/users')->withInput()->with('validation', $this->validation);
      }


      if ($this->roleModel->save([
         'id' => $this->request->getVar('role_id'),
         'role' => $this->request->getVar('role')
      ])) {
         session()->setFlashdata('pesan', 'Role user role <b>' . $this->request->getVar('role') . '</b> berhasil diupdate');
         return redirect()->to('/admin/users');
      } else {
         echo 'gagal';
      }
   }

   public function delete()
   {

      if ($this->roleModel->delete(['id', $this->request->getVar('role_id')])) {
         session()->setFlashdata('pesan', 'Berhasil di delete');
         return redirect()->to('/admin/users');
      } else {
         echo 'gagal';
      }
   }

   //--------------------------------------------------------------------

}
