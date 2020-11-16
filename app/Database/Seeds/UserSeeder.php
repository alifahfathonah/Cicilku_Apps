<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
	public function run()
	{
		$time = Time::now();
		$data = [
			'name' 			=> 'admin',
			'email' 			=> 'admin@cicilku.com',
			'image' 			=> 'default.png',
			'password' 		=> password_hash('admin123', PASSWORD_DEFAULT),
			'role_id' 		=> 1,
			'is_active' 	=> 1,
			'created_at' 	=> $time->timestamp,
			'updated_at' 	=> $time->timestamp,
		];

		// Using Query Builder
		$this->db->table('tbl_user')->insert($data);
	}
}
