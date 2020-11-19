<?php

namespace App\Controllers;

use App\Models\GuruModel;
use App\Controllers\BaseController;

class Guru extends BaseController
{
   protected $guruModel;
   public function __construct()
   {
      $this->guruModel = new GuruModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
      $this->roleIdSession = session()->get('role_id');
   }

   public function index()
   {

      $data = [
         'title' => 'My Dashboard',
         'subMenuTitle' => 'My Dashboard',
         'user' => $this->guruModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db
      ];
      return view('guru/dashboard', $data);
   }

   //--------------------------------------------------------------------

}
