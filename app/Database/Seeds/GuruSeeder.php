<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class GuruSeeder extends Seeder
{
   public function run()
   {
      $time = Time::now();
      $data = [
         'nip'           => 196806152006042006,
         'username'     => 'nartinah',
         'password'     => password_hash('nartinah123', PASSWORD_DEFAULT),
         'nama'         => 'Nartinah, S.Pd.SD',
         'nohp'        => '081234567890',
         'email'        => 'nartinah@gmail.com',
         'image'        => 'default.png',
         'role_id'      => 3, //guru
         'is_active'    => 1,
         'created_at'   => $time->timestamp,
         'updated_at'   => $time->timestamp,
      ];

      // Using Query Builder
      $this->db->table('tbl_guru')->insert($data);
   }
}
