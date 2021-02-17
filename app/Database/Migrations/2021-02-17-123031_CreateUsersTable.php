<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'first_name' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'last_name' => [
				'type'       => 'VARCHAR',
				'constraint' => '50',
			],
			'email' => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'password' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'verification_code' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'verified' => [
				'type'       => 'TINYINT',
				'default'    => 0,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp on update current_timestamp',
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
