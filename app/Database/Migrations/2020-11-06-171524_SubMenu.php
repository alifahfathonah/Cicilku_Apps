<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubMenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'menu_id' => [
				'type' => 'INT',
				'constraint' => 11
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'url' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'icon' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'is_active' => [
				'type' => 'INT',
				'constraint' => 1
			],
			'created_at' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'deleted_at' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
		]);
		$this->forge->addField('id', TRUE);
		$this->forge->createTable('tbl_sub_menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_sub_menu');
	}
}
