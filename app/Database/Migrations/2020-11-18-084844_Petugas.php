<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 32,
				'unsigned' => TRUE,
			],
			'nip' => [
				'type' => 'VARCHAR',
				'constraint' => '20',
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '256'
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'image' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'role_id' => [
				'type' => 'INT',
				'constraint' => 1
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
		$this->forge->createTable('tbl_petugas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_petugas');
	}
}
