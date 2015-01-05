<?php

class m141226_130833_create_tbl_feed extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_feed', array(
            'id'          => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title'       => 'VARCHAR(255) NOT NULL',
            'picture'     => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_feed');
    }
}
