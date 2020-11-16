<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserMenuSeeder extends Seeder
{
	public function run()
	{
		$time = Time::now();
		$data = [
			[
				'menu' 			=> 'Administrator',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu' 			=> 'Menu',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu' 			=> 'Operator',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu' 			=> 'Teacher',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu' 			=> 'Students',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			]
		];

		// Using Query Builder
		$this->db->table('tbl_user_menu')->insertBatch($data);
	}
}
