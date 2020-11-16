<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserRoleSeeder extends Seeder
{
	public function run()
	{
		$time = Time::now();
		$data = [
			[
				'role' 			=> 'Administrator',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role' 			=> 'Operator',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role' 			=> 'Teacher',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role' 			=> 'Students',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			]
		];

		// Using Query Builder
		$this->db->table('tbl_user_role')->insertBatch($data);
		//
	}
}
