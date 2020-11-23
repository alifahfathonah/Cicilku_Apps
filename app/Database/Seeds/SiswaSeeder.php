<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SiswaSeeder extends Seeder
{
   public function run()
   {
      $faker = \Faker\Factory::create('id_ID');
      $time = Time::now();

      for ($i = 1; $i <= 10; $i++) {
         $username =  $faker->userName;
         $kelas_id = $faker->numberBetween(4, 10);
         $name = preg_replace("/[^a-zA-Z]/", " ", $username);
         $ttl = $faker->dateTimeThisCentury();
         $jk = ($faker->randomDigitNotNull % 2 == 0) ? 'Laki Laki' : 'Perempuan';
         $NISN = '0' . $ttl->format('y') . '00' . $i . $faker->numberBetween(0000, 9999);
         $nekening = $faker->numberBetween(100, 999) . $i . $kelas_id . $ttl->format('y') . $faker->numberBetween(1000, 9999);

         $data = [
            'no_rekening' => $nekening,
            'siswa_id' => $i,
            'saldo' => 0,
            'is_active' => 1,
            'created_at'   => $time->timestamp,
            'updated_at'   => $time->timestamp,
         ];
         $this->db->table('tbl_rekening')->insert($data);

         $data2 = [
            'nisn'         => $NISN,
            'username'     =>  $username,
            'password'     => password_hash($username . '123', PASSWORD_DEFAULT),
            'email'        =>  $username . '@' . $faker->freeEmailDomain,
            'nama'         => $name,
            'jk'           => $jk,
            'ttl'          => $ttl->getTimestamp(),
            'nohp'         => $faker->phoneNumber,
            'orangtua'     => $faker->name('male' | 'female'),
            'alamat'       => $faker->address,

            'image'        => 'default.png',
            'role_id'      => 4, //students
            'is_active'    => 1,
            'created_at'   => $time->timestamp,
            'updated_at'   => $time->timestamp,
         ];
         $this->db->table('tbl_siswa')->insert($data2);




         $data3 = [
            'kelas_id' => $kelas_id,
            'siswa_id' => $i,
            'created_at'   => $time->timestamp,
            'updated_at'   => $time->timestamp,
         ];
         $this->db->table('tbl_detail_kelas')->insert($data3);
      }

      // Using Query Builder

   }
}
