<?php

class m141227_075410_create_tbl_profile extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_profile', array(
            'id'         => 'pk',
            'photo'      => 'VARCHAR(255) NOT NULL DEFAULT "no_avatar.png"',
            'info'       => 'VARCHAR(255) NOT NULL',
            'birth'      => 'VARCHAR(255) NOT NULL',
            'registered' => 'DATETIME NOT NULL',
            'user_id'    => 'INT(10) NOT NULL',
            'ban'        => 'TINYINT(10)',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_profile');
    }
}
