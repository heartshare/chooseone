<?php

class m141227_075410_create_tbl_profile extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_profile', array(
            'id'         => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'photo'      => 'VARCHAR(255) NOT NULL DEFAULT "no_avatar.png"',
            'info'       => 'VARCHAR(255) NOT NULL',
            'birth'      => 'VARCHAR(255) NOT NULL',
            'registered' => 'DATETIME NOT NULL',
            'user_id'    => 'INT(10) NOT NULL',
            'ban'        => 'TINYINT(10)',
        ));
        $this->addForeignKey('user_profile', 'tbl_profile', 'user_id', 'tbl_user', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('tbl_profile');
    }
}
