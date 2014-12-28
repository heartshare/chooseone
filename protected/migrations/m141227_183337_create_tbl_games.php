<?php

class m141227_183337_create_tbl_games extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_games', array(
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'genre' => 'VARCHAR(255) NOT NULL',
            'image' => 'VARCHAR(255) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_games');
    }
}
