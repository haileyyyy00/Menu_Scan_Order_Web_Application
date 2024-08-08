<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        // Define the User table
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'isAdmin' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'archived' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'status' => [
                'type' => 'BOOLEAN',
                'default' => true,
            ],
        ]);
        
        $this->forge->addKey('user_id', TRUE); // Set user_id as primary key
        $this->forge->createTable('User'); // Create the User table
    }

    public function down()
    {
        // Drop the User table if needed
        $this->forge->dropTable('User');
    }
}
