<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\SemesterModel;
use App\Models\KelasModel;
use App\Models\GuruModel;
use App\Controllers\BaseController;

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

   public function index()
   {

      if ($this->request->getVar('s')) {
         $set = $this->request->getVar('s');
      } else {
         $get = $this->db->table('tbl_semester')->select()->orderBy('periode_akhir', 'DESC')->get();
         $get = $get->getResultArray();
         $set = $get[0]['id'];
      }

      $data = [
         'title' => 'Class Management',
         'subMenuTitle' => 'Class Management',
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'semester' => $this->semesterModel->findAll(),
         'dsemester' => $this->semesterModel->where(['id' => $set])->first(),
         'kelas' => $this->kelasModel->findAll(),
         'validation' => $this->validation
      ];
      return view('operator/kelas/index', $data);
   }

   public function add()
   {

      $data = [
         'title' => 'New Class',
         'subMenuTitle' => 'Class Management',
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'semester' => $this->semesterModel->findAll(),
         'dsemester' => $this->semesterModel->where(['id' => $this->request->getVar('s')])->first(),
         'guru' => $this->guruModel->findAll(),
         'kelas' => $this->kelasModel->findAll(),
         'validation' => $this->validation
      ];
      return view('operator/kelas/add_kelas', $data);
   }

   // public function save()
   // {

   //    //validation include
   //    if (!$this->validate([
   //       'semester' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'pilih semester!',
   //          ]
   //       ],
   //       'start' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'periode jangan kosong!',
   //          ]
   //       ],
   //       'end' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'periode jangan kosong!',
   //          ]
   //       ]
   //    ])) {
   //       return redirect()->to('/semester')->withInput()->with('validation', $this->validation);
   //    }


   //    if ($this->semesterModel->save([
   //       'semester' => $this->request->getVar('semester'),
   //       'periode_awal' => strtotime($this->request->getVar('start')),
   //       'periode_akhir' => strtotime($this->request->getVar('end')),

   //    ])) {
   //       session()->setFlashdata('pesan', 'Semester <b>' . $this->request->getVar('semester') . '</b> berhasil dibuat');
   //       return redirect()->to('/semester');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

   // public function edit()
   // {
   //    $sid = $this->request->getVar('sid');
   //    $data = [
   //       'title' => 'Edit Semester',
   //       'subMenuTitle' => 'Semester Management',
   //       'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
   //       'db' =>  $this->db,
   //       's' => $this->semesterModel->where(['id' => $sid])->first(),
   //       'validation' => $this->validation
   //    ];

   //    return view('operator/semester/edit_semester', $data);
   // }

   // public function update()
   // {
   //    $sid = $this->request->getVar('id');
   //    //validation include
   //    if (!$this->validate([
   //       'semester' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'pilih semester!',
   //          ]
   //       ],
   //       'start' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'periode jangan kosong!',
   //          ]
   //       ],
   //       'end' => [
   //          'rules' =>   'required|trim',
   //          'errors' => [
   //             'required' => 'periode jangan kosong!',
   //          ]
   //       ]
   //    ])) {
   //       return redirect()->to('/semester/edit?sid=' . $sid)->withInput()->with('validation', $this->validation);
   //    }

   //    // dd($this->request->getVar());
   //    if ($this->semesterModel->save([
   //       'id' => $this->request->getVar('semester_id'),
   //       'semester' => $this->request->getVar('semester'),
   //       'periode_awal' => strtotime($this->request->getVar('start')),
   //       'periode_akhir' => strtotime($this->request->getVar('end')),
   //    ])) {
   //       session()->setFlashdata('pesan', 'Role user menu <b>' . $this->request->getVar('semester') . '</b> berhasil diupdate');
   //       return redirect()->to('/semester');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

   // public function delete()
   // {
   //    if ($this->semesterModel->delete(['id' => $this->request->getPost('sid')])) {

   //       session()->setFlashdata('pesan', 'Semester periode <b>' . $this->request->getVar('periode') . '</b> berhasil dihapus');
   //       return redirect()->to('/semester');
   //    } else {
   //       echo 'gagal';
   //    }
   // }

   //--------------------------------------------------------------------

}
