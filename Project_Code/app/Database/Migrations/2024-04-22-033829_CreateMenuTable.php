<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_on' => [
                'type' => 'DATE',
            ],
            [
            'remarks'=> [
                'type' => 'TEXT',
            ],
            // only menu which visible is set to true will be displayed to the user
            'visible' => [
                'type' => 'BOOLEAN',
                'default' => TRUE,
            ]
            ],
        ]);
        $this->forge->addKey('menu_id', TRUE);
        $this->forge->addForeignKey('user_id', 'User', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Menu');
    }

    public function down()
    {
        $this->forge->dropTable('Menu');
    }
}
