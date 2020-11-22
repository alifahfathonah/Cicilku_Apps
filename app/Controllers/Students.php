<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\PetugasModel;
use App\Controllers\BaseController;
use App\Models\DetailKelasModel;
use App\Models\GuruModel;
use App\Models\KelasModel;
use App\Models\SemesterModel;
use App\Models\RekeningModel;
use CodeIgniter\I18n\Time;

class Students extends BaseController
{
   protected $siswaModel;
   protected $kelasModel;
   protected $semesterModel;
   protected $rekeningModel;
   protected $teacherModel;

   public function __construct()
   {
      $this->siswaModel = new SiswaModel();
      $this->petugasModel = new PetugasModel();
      $this->kelasModel = new KelasModel();
      $this->detailKelasModel = new DetailKelasModel();
      $this->rekeningModel = new RekeningModel();
      $this->teacherModel = new GuruModel();
      $this->semesterModel = new SemesterModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index($id = null)
   {
      if ($id) {
         $detail = $this->siswaModel->where(['id' => decrypt_url($id)])->first();

         $detailkelas =  $this->detailKelasModel->where(['siswa_id' => $detail['id']])->first();

         $kelas = $this->kelasModel->where('id', $detailkelas['kelas_id'])->first();

         $data = [
            'title' => $detail['nama'] . ' (' . $detail['nisn'] . ')',
            'subMenuTitle' => 'Students Management',
            'db' =>  $this->db,
            'siswa' => $this->siswaModel->where(['id' => decrypt_url($id)])->first(),
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'rekening' => $this->rekeningModel->where(['siswa_id' => $detail['id']])->first(),
            'semester' => $this->semesterModel->findAll(),
            'kelas' => $kelas,
            'guru' => $this->teacherModel->where('id', $kelas['guru_id'])->first(),
            'validation' => $this->validation,
         ];
         return view('operator/siswa/detail_siswa', $data);
      } else {
         $data = [
            'title' => 'Students Management',
            'subMenuTitle' => 'Students Management',
            'db' =>  $this->db,
            'siswa' => $this->siswaModel->findAll(),
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'validation' => $this->validation,
         ];
         return view('operator/siswa/index', $data);
      }
   }

   public function add()
   {
      $time = Time::now();
      $time->timestamp;
      $semesternow =  $this->semesterModel->having(['periode_awal <= ' => $time->timestamp, 'periode_akhir >= ' => $time->timestamp])->findAll();

      $faker = \Faker\Factory::create('id_ID');
      $faker->creditCardNumber;

      $data = [
         'title' => 'Add Students',
         'subMenuTitle' => 'Students Management',
         'db' =>  $this->db,
         'siswa' => $this->siswaModel->findAll(),
         'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
         'kelas' => $this->kelasModel->where(['semester_id' => $semesternow[0]['id']])->orderby('kelas', 'ASC')->findAll(),
         'validation' => $this->validation,
         'rekening' => $faker->creditCardNumber
      ];
      return view('operator/siswa/add_siswa', $data);
   }

   public function save()
   {

      //validation include
      if (!$this->validate([
         'no_rek' => [
            'rules' =>   'required|trim|is_unique[tbl_rekening.no_rekening]|numeric',
            'errors' => [
               'required' => 'Nomor Rekening tidak boleh kosong!',
               'is_unique' => 'Nomor Rekening sudah digunakan.',
               'numeric' => 'Harus berupa angka.'
            ]
         ],
         'nisn' => [
            'rules' =>   'required|trim|is_unique[tbl_siswa.nisn]|numeric',
            'errors' => [
               'required' => 'NISN tidak boleh kosong!',
               'is_unique' => 'NISN sudah ada.',
               'numeric' => 'Harus berupa angka.'
            ]
         ],
         'nama' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Nama tidak boleh kosong!',
            ]
         ],
         'ttl' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Tempat Tanggal Lahir tidak boleh kosong!',
            ]
         ],
         'jk' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Pilih jenis kelamin!',
            ]
         ],
         'class' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Pilih kelas!',
            ]
         ],
         'ortu' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Nama Orang Tua tidak boleh kosong!',
            ]
         ],
         'alamat' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Alamat tidak boleh kosong!',
            ]
         ],
         'nohp' => [
            'rules' =>   'required|trim|numeric',
            'errors' => [
               'required' => 'No Telephone tidak boleh kosong!',
               'numeric' => 'Harus berupa angka.'
            ]
         ],
         'email' => [
            'rules' =>   'required|trim|valid_email',
            'errors' => [
               'required' => 'Email tidak boleh kosong!',
               'valid_email' => 'Harus berupa Email!'
            ]
         ],
         'username' => [
            'rules' =>   'required|trim|is_unique[tbl_siswa.username]|alpha_numeric',
            'errors' => [
               'required' => 'Username tidak boleh kosong!',
               'is_unique' => 'Username sudah digunakan.',
               'alpha_numeric' => 'Harus Berupa huruf atau angka atau kombinasinya.'
            ]
         ],
         'password' => [
            'rules' =>   'required|trim',
            'errors' => [
               'required' => 'Password tidak boleh kosong!',

            ]
         ],
      ])) {
         return redirect()->to('/students/add')->withInput()->with('validation', $this->validation);
      }
      // dd($this->request->getVar());

      if ($this->siswaModel->save([
         'nisn' => $this->request->getVar('nisn'),
         'username' => $this->request->getVar('username'),
         'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
         'email' => $this->request->getVar('email'),
         'nama' => $this->request->getVar('nama'),
         'jk' => $this->request->getVar('jk'),
         'ttl' => strtotime($this->request->getVar('ttl')),
         'nohp' => $this->request->getVar('nohp'),
         'orangtua' => $this->request->getVar('ortu'),
         'alamat' => $this->request->getVar('alamat'),
         'image' => 'default.png',
         'role_id' => 4, //students
         'is_active' => 1
      ])) {


         return redirect()->to('/students-rek/' . encrypt_url($this->request->getVar('username')) . '/' . encrypt_url($this->request->getVar('no_rek')) . '/' . encrypt_url($this->request->getVar('class')));
      } else {
         echo 'gagal';
      }
   }

   public function add_rekening($username, $no_rek, $class)
   {
      $students = $this->siswaModel->where(['username' => decrypt_url($username)])->first();

      if ($this->rekeningModel->save([
         'no_rekening' =>  decrypt_url($no_rek),
         'siswa_id' => $students['id'],
         'saldo' => 0,
         'is_active' => 1
      ])) {
         if ($this->detailKelasModel->save([
            'kelas_id' => decrypt_url($class),
            'siswa_id' =>  $students['id']
         ])) {
            session()->setFlashdata('pesan', ' Data <b>' . $students['nama'] . '</b> berhasil dibuat');
            return redirect()->to('/students');
         }
      } else {
         echo 'gagal';
      }
   }

   public function delete()
   {

      dd($this->request->getVar());

      if ($this->siswaModel->delete(['id', $this->request->getVar('id')])) {
         $this->rekeningModel->delete(['id', $this->request->getVar('id_rekening')]);
         session()->setFlashdata('pesan', 'Data <b>' . $this->request->getVar('nama') . '</b>  berhasil di delete');
         return redirect()->to('/students');
      } else {
         echo 'gagal';
      }
   }

   public function update($id = null)
   {

      if ($id) {
         $detail = $this->siswaModel->where(['id' => decrypt_url($id)])->first();

         $detailkelas =  $this->detailKelasModel->where(['siswa_id' => $detail['id']])->first();

         $kelas = $this->kelasModel->where('id', $detailkelas['kelas_id'])->first();

         $time = Time::now();
         $time->timestamp;
         $semesternow =  $this->semesterModel->having(['periode_awal <= ' => $time->timestamp, 'periode_akhir >= ' => $time->timestamp])->findAll();

         $faker = \Faker\Factory::create('id_ID');
         $faker->creditCardNumber;

         $data = [
            'title' => $detail['nama'] . ' (' . $detail['nisn'] . ')',
            'subMenuTitle' => 'Students Management',
            'db' =>  $this->db,
            'siswa' => $this->siswaModel->where(['id' => decrypt_url($id)])->first(),
            'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
            'kelas' => $this->kelasModel->where(['semester_id' => $semesternow[0]['id']])->orderby('kelas', 'ASC')->findAll(),
            'validation' => $this->validation,
            'rekening' => $this->rekeningModel->where(['siswa_id' => $detail['id']])->first(),
            'semester' => $this->semesterModel->findAll(),
            'dkelas' => $detailkelas,
            'guru' => $this->teacherModel->where('id', $kelas['guru_id'])->first(),
            'validation' => $this->validation,
         ];
         return view('operator/siswa/edit_siswa', $data);
      } else {
         // dd($this->request->getVar());


         $cek_username = $this->siswaModel->where(['username' => $this->request->getVar('username')])->first();
         if ($cek_username) {
            $is_unique_username = ($cek_username['id'] === $this->request->getVar('id')) ? '' : '|is_unique[tbl_siswa.username]';
            $err_is_unique_username = ($cek_username['id'] === $this->request->getVar('id')) ? "" :  " 'is_unique' => 'Username sudah digunakan.' ";
         } else {
            $is_unique_username = '';
            $err_is_unique_username = '';
         }

         $cek_nisn = $this->siswaModel->where(['nisn' => $this->request->getVar('nisn')])->first();
         if ($cek_nisn) {
            $is_unique_nisn = ($cek_nisn['id'] === $this->request->getVar('id')) ? '' : '|is_unique[tbl_siswa.nisn]';
            $err_is_unique_nisn = ($cek_nisn['id'] === $this->request->getVar('id')) ? "" :  " 'is_unique' => 'NISN sudah ada.' ";
         } else {
            $is_unique_nisn = '';
            $err_is_unique_nisn = '';
         }

         //validation include
         if (!$this->validate([
            'nisn' => [
               'rules' =>   'required|trim' . $is_unique_nisn . '|numeric',
               'errors' => [
                  'required' => 'NISN tidak boleh kosong!',
                  $err_is_unique_nisn,
                  'numeric' => 'Harus berupa angka.'
               ]
            ],
            'nama' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Nama tidak boleh kosong!',
               ]
            ],
            'ttl' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Tempat Tanggal Lahir tidak boleh kosong!',
               ]
            ],
            'jk' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Pilih jenis kelamin!',
               ]
            ],
            'class' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Pilih kelas!',
               ]
            ],
            'ortu' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Nama Orang Tua tidak boleh kosong!',
               ]
            ],
            'alamat' => [
               'rules' =>   'required|trim',
               'errors' => [
                  'required' => 'Alamat tidak boleh kosong!',
               ]
            ],
            'nohp' => [
               'rules' =>   'required|trim|numeric',
               'errors' => [
                  'required' => 'No Telephone tidak boleh kosong!',
                  'numeric' => 'Harus berupa angka.'
               ]
            ],
            'email' => [
               'rules' =>   'required|trim|valid_email',
               'errors' => [
                  'required' => 'Email tidak boleh kosong!',
                  'valid_email' => 'Harus berupa Email!'
               ]
            ],
            'username' => [
               'rules' =>   'required|trim' . $is_unique_username . '|alpha_numeric',
               'errors' => [
                  'required' => 'Username tidak boleh kosong!',
                  $err_is_unique_username,
                  'alpha_numeric' => 'Harus Berupa huruf atau angka atau kombinasinya.'
               ]
            ],
         ])) {
            return redirect()->to('/students/' . encrypt_url($this->request->getVar('id')) . '/edit')->withInput()->with('validation', $this->validation);
         }

         $is_active  = ($this->request->getVar('is_active')) ? 1 : 0;

         if ($this->siswaModel->save([
            'id' => $this->request->getVar('id'),
            'nisn' => $this->request->getVar('nisn'),
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'nama' => $this->request->getVar('nama'),
            'jk' => $this->request->getVar('jk'),
            'ttl' => strtotime($this->request->getVar('ttl')),
            'nohp' => $this->request->getVar('nohp'),
            'orangtua' => $this->request->getVar('ortu'),
            'alamat' => $this->request->getVar('alamat'),
            'image' => 'default.png',
            'role_id' => 4, //students
            'is_active' => $is_active
         ])) {
            if ($this->detailKelasModel->save([
               'id' => $this->request->getVar('id_detail_kelas'),
               'kelas_id' => $this->request->getVar('class'),
               'siswa_id' => $this->request->getVar('id')
            ])) {
               session()->setFlashdata('pesan', 'Data <b>' . $this->request->getVar('nama') . '</b>  berhasil diupdate');
               return redirect()->to('/students/' . encrypt_url($this->request->getVar('id')))->withInput()->with('validation', $this->validation);
            }
         } else {
            echo 'gagal';
         }
      }
   }
   // public function update($id = null)
   // {
   //    if ($id) {

   //       $data = [
   //          'title' => 'Edit Teacher',
   //          'subMenuTitle' => 'Teacher Management',
   //          'db' =>  $this->db,
   //          'guru' => $this->guruModel->where(['id' => decrypt_url($id)])->first(),
   //          'user' => $this->petugasModel->where(['id' => $this->idUserSession])->first(),
   //          'validation' => $this->validation
   //       ];
   //       return view('operator/guru/edit_guru', $data);
   //    } else {

   //       $cek_username = $this->guruModel->where(['username' => $this->request->getVar('username')])->first();
   //       if ($cek_username) {
   //          $is_unique = ($cek_username['id'] === $this->request->getVar('id')) ? '' : '|is_unique[tbl_guru.username]';
   //          $err_is_unique = ($cek_username['id'] === $this->request->getVar('id')) ? "" :  " 'is_unique' => 'Username sudah digunakan.' ";
   //       } else {
   //          $is_unique = '';
   //          $err_is_unique = '';
   //       }
   //       //validation include
   //       if (!$this->validate([
   //          'nip' => [
   //             'rules' =>   'required|trim|is_unique[tbl_guru.nip]alpha_numeric',
   //             'errors' => [
   //                'required' => 'Nomor Induk Pegawai tidak boleh kosong!',
   //                'is_unique' => 'Nomor Induk Pegawai sudah ada.',
   //                'alpha_numeric' => 'Nomor Induk tidak benar.'
   //             ]
   //          ],
   //          'nama' => [
   //             'rules' =>   'required|trim',
   //             'errors' => [
   //                'required' => 'Nama tidak boleh kosong!',
   //             ]
   //          ],
   //          'nohp' => [
   //             'rules' =>   'required|trim|numeric',
   //             'errors' => [
   //                'required' => 'No Telephone tidak boleh kosong!',
   //                'numeric' => 'Harus berupa angka.'
   //             ]
   //          ],
   //          'email' => [
   //             'rules' =>   'required|trim|valid_email',
   //             'errors' => [
   //                'required' => 'Email tidak boleh kosong!',
   //                'valid_email' => 'Harus berupa Email!'
   //             ]
   //          ],
   //          'username' => [
   //             'rules' =>   'required|trim' . $is_unique . '|alpha_numeric',
   //             'errors' => [
   //                'required' => 'Username tidak boleh kosong!',
   //                $err_is_unique,
   //                'alpha_numeric' => 'Harus Berupa huruf atau angka atau kombinasinya.'

   //             ]
   //          ],
   //       ])) {
   //          return redirect()->to('/teachers/' . encrypt_url($this->request->getVar('id')) . '/edit')->withInput()->with('validation', $this->validation);
   //       }

   //       $is_active  = ($this->request->getVar('is_active')) ? 1 : 0;

   //       if ($this->guruModel->save([
   //          'id' => $this->request->getVar('id'),
   //          'nip' => $this->request->getVar('nip'),
   //          'username' => $this->request->getVar('username'),
   //          'email' => $this->request->getVar('email'),
   //          'nama' => $this->request->getVar('nama'),
   //          'nohp' => $this->request->getVar('nohp'),
   //          'image' => 'default.png',
   //          'role_id' => 3, //guru
   //          'is_active' => $is_active
   //       ])) {
   //          session()->setFlashdata('pesan', ' Data <b>' . $this->request->getVar('nama') . '</b> berhasil diUpdate');
   //          return redirect()->to('/teachers');
   //       } else {
   //          echo 'gagal';
   //       }
   //    }
   // }

   // public function changepassword()
   // {
   //    if ($this->guruModel->save([
   //       'id' => $this->request->getVar('id'),
   //       'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
   //    ])) {
   //       session()->setFlashdata('pesan', ' Password <b>' . $this->request->getVar('nama') . '</b> berhasil diUpdate (Pass : ' . $this->request->getVar('password') . ')');
   //       return redirect()->to('/teachers');
   //    } else {
   //       echo 'gagal';
   //    }
   // }



   //--------------------------------------------------------------------

}
