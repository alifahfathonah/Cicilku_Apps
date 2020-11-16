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
				'url'				=> 'admin/role',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 1, //Admistrator
				'title'			=> 'Users Management',
				'url'				=> 'admin/users',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 2, //Menu
				'title'			=> 'Menu Management',
				'url'				=> 'admin/menu',
				'icon'			=> 'fa fa-list',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 2, //Menu
				'title'			=> 'Sub Menu Management',
				'url'				=> 'admin/submenu',
				'icon'			=> 'fa fa-list',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Manajemen Kelas',
				'url'				=> 'operator/class',
				'icon'			=> 'fas fa-border-all',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Manajemen Guru',
				'url'				=> 'operator/teachers',
				'icon'			=> 'fas fa-chalkboard-teacher',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Manajemen Siswa',
				'url'				=> 'operator/students',
				'icon'			=> 'fa fa-users',
				'is_active'		=> '1',
				'created_at' 	=> $time->timestamp,
				'updated_at' 	=> $time->timestamp
			],
			[
				'menu_id' 		=> 3, //Operator
				'title'			=> 'Manajemen Tabungan',
				'url'				=> 'operator/savings',
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
