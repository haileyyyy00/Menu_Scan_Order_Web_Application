<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuItemTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type' => 'DECIMAL(10,2)',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
        ]);

        $this->forge->addKey('menu_item_id', TRUE);
        $this->forge->addForeignKey('menu_id', 'Menu', 'menu_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Menu_Item');
    }

    public function down()
    {
        $this->forge->dropTable('Menu_Item');
    }
}
