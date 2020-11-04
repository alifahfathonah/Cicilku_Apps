<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Controllers\BaseController;

class Menu extends BaseController
{
   protected $userModel;
   public function __construct()
   {
      $this->userModel = new UserModel();
      $this->menuModel = new MenuModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {

      $data = [
         'title' => 'Menu Management',
         'subMenuTitle' => 'Menu Management',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'menu' => $this->menuModel->findAll()
      ];
      return view('menu/index', $data);
   }

   public function new()
   {
     
   }

   //--------------------------------------------------------------------

}
