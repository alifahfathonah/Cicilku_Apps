<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PetugasSeeder extends Seeder
{
   public function run()
   {
      $time = Time::now();
      $data = [
         'nip'           => 18120571,
         'username'     => 'ferdian',
         'password'     => password_hash('ferdian123', PASSWORD_DEFAULT),
         'nama'         => 'ferdian arjun',
         'email'        => 'ferdianarjun@cicilku.com',
         'image'        => 'default.png',
         'role_id'      => 2, //petugas
         'is_active'    => 1,
         'created_at'   => $time->timestamp,
         'updated_at'   => $time->timestamp,
      ];

      // Using Query Builder
      $this->db->table('tbl_petugas')->insert($data);
   }
}
