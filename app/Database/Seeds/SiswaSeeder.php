<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SiswaSeeder extends Seeder
{
   public function run()
   {
      $time = Time::now();
      $data = [
         'id'           => 121212,
         'username'     => 'budi',
         'password'     => password_hash('budi123', PASSWORD_DEFAULT),
         'nama'         => 'budi yanto',
         'email'        => 'budi@cicilku.com',
         'image'        => 'default.png',
         'role_id'      => 4, //students
         'is_active'    => 1,
         'created_at'   => $time->timestamp,
         'updated_at'   => $time->timestamp,
      ];

      // Using Query Builder
      $this->db->table('tbl_siswa')->insert($data);
   }
}
