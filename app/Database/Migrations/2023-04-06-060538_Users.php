<?php 

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([

            'username'          => [
                'type'           => 'VARCHAR',
				'constraint'     => '150',
			],
			'password'       => [
                'type'           => 'VARCHAR',
				'constraint'     => '150',
			],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            
		]);
		$this->forge->addPrimaryKey('username', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
