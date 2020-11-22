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

      for ($i = 0; $i < 10; $i++) {
         $username =  $faker->userName;
         $name = preg_replace("/[^a-zA-Z]/", " ", $username);
         $jk = ($faker->randomDigitNotNull % 2 == 0) ? 'Laki Laki' : 'Perempuan';
         $NISN = '0' . $faker->dateTimeThisCentury->format('y') . '00' . $i . $faker->numberBetween(0000, 9999);


         $data = [
            'nisn'         => $NISN,
            'username'     =>  $username,
            'rekening_id'  => $faker->creditCardNumber,
            'password'     => password_hash($username . '123', PASSWORD_DEFAULT),
            'nama'         => $name,
            'email'        =>  $username . '@' . $faker->freeEmailDomain,
            'nohp'         => $faker->phoneNumber,
            'orangtua'     => $faker->name('male' | 'female'),
            'alamat'       => $faker->address,
            'jk'           => $jk,
            'image'        => 'default.png',
            'role_id'      => 4, //students
            'is_active'    => 1,
            'created_at'   => $time->timestamp,
            'updated_at'   => $time->timestamp,
         ];
         $this->db->table('tbl_siswa')->insert($data);
      }

      // Using Query Builder

   }
}
