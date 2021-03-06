<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Admin extends BaseController
{
   protected $userModel;
   public function __construct()
   {
      $this->userModel = new UserModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
      $this->roleIdSession = session()->get('role_id');
   }

   public function index()
   {

      $data = [
         'title' => 'My Dashboard',
         'subMenuTitle' => 'Dashboard Admin',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db
      ];
      return view('admin/dashboard', $data);
   }

   //--------------------------------------------------------------------

}
