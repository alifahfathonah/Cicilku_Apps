<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\SemesterModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;

class Kelas extends BaseController
{
   protected $petugasModel;
   protected $semesterModel;
   protected $kelasModel;
   protected $guruModel;
   public function __construct()
   {
      $this->petugasModel = new PetugasModel();
      $this->semesterModel = new SemesterModel();
      $this->guruModel = new GuruModel();
      $this->kelasModel = new KelasModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
      $this->roleIdSession = session()->get('role_id');
   }

   public function index($semester_id = null)
   {
      if ($semester_id) {
         $data = [
            'title' => 'Class Management',
            'subMenuTitle' => 'Class Management',
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'db' =>  $this->db,
            'semester' => $this->semesterModel->findAll(),
            'detail_semester' => $this->semesterModel->where(['id' => decrypt_url($semester_id)])->first(),
            'kelas' => $this->kelasModel->where('semester_id', (decrypt_url($semester_id)))->orderBy('kelas', 'ASC')->findAll(),
            'validation' => $this->validation
         ];
         return view('operator/kelas/index', $data);
      } else {
         $data = [
            'title' => 'Class Management',
            'subMenuTitle' => 'Class Management',
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'db' =>  $this->db,
            'semester' => $this->semesterModel->findAll(),
            'kelas' => $this->kelasModel->findAll(),
            'validation' => $this->validation
         ];


         $time = Time::now();
         $time->timestamp;
         $semesternow =  $this->semesterModel->having(['periode_awal <= ' => $time->timestamp, 'periode_akhir >= ' => $time->timestamp])->findAll();
         if ($semesternow) {
            return redirect()->to('/class/semester/' . encrypt_url($semesternow[0]['id']));
         }
         return view('operator/kelas/index', $data);
      }
   }

   public function add($id_semester = null)
   {

      $data = [
         'title' => 'New Class',
         'subMenuTitle' => 'Class Management',
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'semester' => $this->semesterModel->findAll(),
         'dsemester' => $this->semesterModel->where(['id' => decrypt_url($id_semester)])->first(),
         'guru' => $this->guruModel->findAll(),
         'kelas' => $this->kelasModel->findAll(),
         'validation' => $this->validation
      ];


      return view('operator/kelas/add_kelas', $data);
   }

   public function save()
   {
      if ($this->kelasModel->where(['semester_id' => $this->request->getVar('semester')])->where(['kelas' => $this->request->getVar(['title'])])->first()) {
         session()->setFlashdata('pesan', 'Kelas <b>' . $this->request->getVar('title') . '</b> sudah ada');
         return redirect()->to('/class/' . encrypt_url($this->request->getVar('semester')) . '/add');
      } else {
         $is_active = ($this->request->getVar('is_active')) ? 1 : 0;
         if ($this->kelasModel->save([
            'semester_id' => $this->request->getVar('semester'),
            'guru_id' => $this->request->getVar('guru'),
            'kelas' => $this->request->getVar('title'),
            'is_active' =>  $is_active
         ])) {
            session()->setFlashdata('pesan', 'Kelas <b>' . $this->request->getVar('title') . '</b> berhasil dibuat');
            return redirect()->to('/class/semester/' . encrypt_url($this->request->getVar('semester')));
         } else {
            echo 'gagal';
         }
      }
   }


   public function update($id_semester = null, $id_kelas = null)
   {
      if ($id_kelas) {

         $data = [
            'title' => 'Edit Class',
            'subMenuTitle' => 'Class Management',
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'db' =>  $this->db,
            'semester' => $this->semesterModel->findAll(),
            'dsemester' => $this->semesterModel->where(['id' => decrypt_url($id_semester)])->first(),
            'kelas' => $this->kelasModel->where(['id' => decrypt_url($id_kelas)])->first(),
            'guru' => $this->guruModel->findAll(),
            'validation' => $this->validation
         ];
         return view('operator/kelas/edit_kelas', $data);
      } else {

         if ($this->kelasModel
            ->where([
               'semester_id' => $this->request->getVar('semester'),
               'kelas' => $this->request->getVar('title'),
               'id !=' => $this->request->getVar('id')
            ])->first()
         ) {
            session()->setFlashdata('pesan', 'Kelas <b>' . $this->request->getVar('title') . '</b> sudah ada');
            return redirect()->to('/class/' . encrypt_url($this->request->getVar('semester')) . '/' . encrypt_url($this->request->getVar('id')) . '/edit');
         } else {

            $is_active = ($this->request->getVar('is_active')) ? 1 : 0;
            if ($this->kelasModel->save([
               'id' => $this->request->getVar('id'),
               'semester_id' => $this->request->getVar('semester'),
               'guru_id' => $this->request->getVar('guru'),
               'kelas' => $this->request->getVar('title'),
               'is_active' =>  $is_active
            ])) {
               session()->setFlashdata('pesan', '<b>' . $this->request->getVar('title') . '</b> berhasil diupdate');
               return redirect()->to('/class/semester/' . encrypt_url($this->request->getVar('semester')));
            } else {
               echo 'gagal';
            }
         }
      }
   }
   public function delete()
   {

      if ($this->kelasModel->delete(['id', $this->request->getVar('id')])) {
         session()->setFlashdata('pesan', 'Data <b>' . $this->request->getVar('nama') . '</b>  berhasil di delete');
         return redirect()->to('/class');
      } else {
         echo 'gagal';
      }
   }

   //--------------------------------------------------------------------

}
