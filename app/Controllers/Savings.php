<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\DetailKelasModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SemesterModel;
use App\Models\RekeningModel;
use App\Models\SetoranModel;
use CodeIgniter\I18n\Time;

class Savings extends BaseController
{
   protected $petugasModel;
   public function __construct()
   {
      $this->siswaModel = new SiswaModel();
      $this->petugasModel = new PetugasModel();
      $this->kelasModel = new KelasModel();
      $this->detailKelasModel = new DetailKelasModel();
      $this->rekeningModel = new RekeningModel();
      $this->teacherModel = new GuruModel();
      $this->semesterModel = new SemesterModel();
      $this->setoranModel = new SetoranModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {


      $data = [
         'title' => 'Savings Management',
         'subMenuTitle' => 'Savings Management',
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'siswa' => $this->siswaModel->findAll(),
         'setoran' => $this->setoranModel->where(['status' => 'pending'])->findAll(),
         'transaksiMasuk' => $this->setoranModel->where(['status' => 'done'])->findAll(),
         'kelas' => $this->kelasModel->orderBy('kelas')->findAll(),
      ];
      return view('operator/tabungan/index', $data);
   }

   public function update()
   {

      foreach ($this->request->getVar('id_setoran') as  $id) {
         $setoran =  $this->setoranModel->where(['id' => $id])->first();
         $rekening = $this->rekeningModel->where(['id' => $setoran['rekening_id']])->first();

         $totalSaldo = $rekening['saldo'] + $setoran['nominal'];

         $this->rekeningModel->save([
            'id' => $rekening['id'],
            'saldo' =>  $totalSaldo
         ]);

         $this->setoranModel->save([
            'id' => $setoran['id'],
            'status' => 'done',
            'sisa_saldo' => $totalSaldo
         ]);
      }
      return redirect()->to('/savings');
   }

   //--------------------------------------------------------------------

}
