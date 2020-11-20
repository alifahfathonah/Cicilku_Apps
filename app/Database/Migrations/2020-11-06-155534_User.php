<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
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
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'image' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 11
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
		$this->forge->createTable('tbl_user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_user');
	}
}
