<?php

class m141226_130730_create_tbl_user extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_user', array(
            'id'       => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'login'    => 'VARCHAR(255) NOT NULL',
            'password' => 'VARCHAR(255) NOT NULL',
            'email'    => 'VARCHAR(255) NOT NULL',
            'role'     => 'TINYINT(3) DEFAULT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_user');
    }
}
