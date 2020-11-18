<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Semester extends Migration
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
			'semester' => [
				'type' => 'VARCHAR',
				'constraint' => '128'
			],
			'periode_awal' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'periode_akhir' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'created_at' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
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
		$this->forge->createTable('tbl_semester');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_semester');
	}
}
