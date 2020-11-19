<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Controllers\BaseController;

class Siswa extends BaseController
{
   protected $siswaModel;
   public function __construct()
   {
      $this->siswaModel = new SiswaModel();
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
         'user' => $this->siswaModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db
      ];
      return view('guru/dashboard', $data);
   }

   //--------------------------------------------------------------------

}
