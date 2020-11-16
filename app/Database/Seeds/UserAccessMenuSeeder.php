<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserAccessMenuSeeder extends Seeder
{
	public function run()
	{
		$time = Time::now();
		$data = [
			[
				'role_id' 		=> 1, //User Admistrator
				'menu_id' 		=> 1, //Admistrator
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 1, //User Admistrator
				'menu_id' 		=> 2, //Menu
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 1, //User Admistrator
				'menu_id' 		=> 3, //Operator
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 1, //User Admistrator
				'menu_id' 		=> 4, //Teacher
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 1, //User Admistrator
				'menu_id' 		=> 5, //Students
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 2, //User Operator
				'menu_id' 		=> 3, //Operator
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 3, //User Teacher
				'menu_id' 		=> 4, //Teacher
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'role_id' 		=> 4, //User Students
				'menu_id' 		=> 5, //Students
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
		];

		// Using Query Builder
		$this->db->table('tbl_user_access_menu')->insertBatch($data);
	}
}
