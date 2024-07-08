<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buku extends Migration
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
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'penerbit' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tahun_terbit' => [
                'type' => 'INT',
                'constraint' => 4
            ],
            'jumlah_halaman' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'deskripsi' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ]
        ]);

        $this->forge->addPrimaryKey('id');
    }

    public function down()
    {
        $this->forge->dropTable('buku');
    }
}

