<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoginUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userId' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'userFullName' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'userEmail' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'userPhone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'userPosition' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userPassword' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'userPicture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userBreanch' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'userAccountType' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'userSignature' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userApplicationFile' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userAccountActiveStatus' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ],
            'userAccountActivationCode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'userAccountVerificationCode' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'userAccountVerified' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ],
            'userFailedLoginAttempts' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ],
            'userLastFailedLogin' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'userAccountLockedUntil' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'userDepartment' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userCreatedBy' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'userDateCreated' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'userAccountLastModifiedDate' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'userAccountLastModifiedBy' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ]
        ]);

        $this->forge->addPrimaryKey('userId');
        $this->forge->addUniqueKey('userEmail');
        $this->forge->createTable('login_users');
    }

    public function down()
    {
        $this->forge->dropTable('login_users');
    }
}