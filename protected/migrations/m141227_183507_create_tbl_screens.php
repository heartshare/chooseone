<?php

class m141227_183507_create_tbl_screens extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_screens', array(
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'image' => 'VARCHAR(255) NOT NULL',
            'game_id' => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_screens');
    }
}
