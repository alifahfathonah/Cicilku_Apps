<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Controllers\BaseController;

class Operator extends BaseController
{
   protected $petugasModel;
   public function __construct()
   {
      $this->petugasModel = new PetugasModel();
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
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db
      ];
      return view('operator/dashboard', $data);
   }

   //--------------------------------------------------------------------

}
