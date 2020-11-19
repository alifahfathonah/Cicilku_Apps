<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class SubMenuSeeder extends Seeder
{
	public function run()
	{
		$time = Time::now();
		$data = [
			[
				'menu_id' 		=> 1, //Admistrator
				'title'			=> 'Dashboard Admin',
				'url'				=> 'admin',
				'icon'			=> 'fa fa-home',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 1, //Admistrator
				'title'			=> 'Access Management',
				'url'				=> 'role',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 1, //Admistrator
				'title'			=> 'Users Management',
				'url'				=> 'users',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 2, //Menu
				'title'			=> 'Menu Management',
				'url'				=> 'menu',
				'icon'			=> 'fa fa-list',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 2, //Menu
				'title'			=> 'Sub Menu Management',
				'url'				=> 'menu/submenu',
				'icon'			=> 'fa fa-list',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Dashboard',
				'url'				=> 'op',
				'icon'			=> 'fa fa-home',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Semester Management',
				'url'				=> 'semester',
				'icon'			=> 'fa fa-home',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Class Management',
				'url'				=> 'class',
				'icon'			=> 'fas fa-border-all',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Teacher Management',
				'url'				=> 'teachers',
				'icon'			=> 'fas fa-chalkboard-teacher',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Students Management',
				'url'				=> 'students',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Savings Management',
				'url'				=> 'savings',
				'icon'			=> 'fas fa-hand-holding-usd',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
		];

		// Using Query Builder
		$this->db->table('tbl_sub_menu')->insertBatch($data);
	}
}
