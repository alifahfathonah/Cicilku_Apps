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

class Rekening extends BaseController
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

   public function topup($id = null)
   {

      $data = [
         'semester' => $this->semesterModel->findAll(),
         'rekening' => $this->rekeningModel->where(['siswa_id' => decrypt_url($id)])->first(),
         'siswa' => $this->siswaModel->where(['id' => decrypt_url($id)])->first(),
         'kelas' => $this->db->table('tbl_kelas')->select()->join('tbl_detail_kelas', 'tbl_detail_kelas.kelas_id = tbl_kelas.id')
            ->where(['tbl_detail_kelas.siswa_id' => decrypt_url($id)])->get()->getResult(),
      ];
      return view('operator/tester/topup', $data);
   }

   public function setor()
   {


      $this->setoranModel->save([
         'semester_id' => $this->request->getVar('semester_id'),
         'rekening_id' => $this->request->getVar('rekening_id'),
         'siswa_id' => $this->request->getVar('siswa_id'),
         'guru_id' => $this->request->getVar('guru_id'),
         'nominal' => $this->request->getVar('nominal'),
         'keterangan' => $this->request->getVar('keterangan'),
         'status' => $this->request->getVar('status')
      ]);

      return redirect()->to('/students/' . encrypt_url($this->request->getVar('siswa_id')));
   }

   //--------------------------------------------------------------------

}
