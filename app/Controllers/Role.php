<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\MenuModel;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Role extends BaseController
{
   protected $userModel;
   protected $roleModel;
   protected $menuModel;
   public function __construct()
   {
      $this->userModel = new UserModel();
      $this->roleModel = new RoleModel();
      $this->menuModel = new MenuModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {
      helper(['my']);
      $data = [
         'title' => 'Access Management',
         'subMenuTitle' => 'Access Management',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'role' => $this->roleModel->findAll(),
         'menu' => $this->menuModel->findAll()
      ];
      return view('admin/user_role/index', $data);
   }
   public function unlock()
   {
      //user check in database
      $user = $this->userModel->where(['id' => $this->idUserSession])->first();
      $user['password'];

      if (password_verify($this->request->getPost('password'), $user['password'])) {


         session()->set(['admin_unlock' => 1]);
         session()->setFlashdata('pesan', "Access Unclock!");
         return redirect()->to('/role');
      } else {
         return redirect()->to('/role');
      }
   }

   public function changeaccess()
   {
      $time = Time::now();
      $data = [
         'role_id' => $this->request->getVar('roleId'),
         'menu_id' => $this->request->getVar('menuId'),
      ];

      $result = $this->db->table('tbl_user_access_menu')->where($data)->get();

      if ($result->getRowArray() < 1) { //centang access
         $data = [
            'role_id' => $this->request->getVar('roleId'),
            'menu_id' => $this->request->getVar('menuId'),
            'created_at' => $time->timestamp,
            'updated_at' => $time->timestamp
         ];
         $this->db->table('tbl_user_access_menu')->insert($data);
         session()->setFlashdata('pesan', "Access Changed!");
      } else {
         $this->db->table('tbl_user_access_menu')->delete($data);
         session()->setFlashdata('pesan', "Access Denied!");
      }
   }

   //--------------------------------------------------------------------

}
