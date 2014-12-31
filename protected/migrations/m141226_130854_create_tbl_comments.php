<?php

class m141226_130854_create_tbl_comments extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_comments', array(
            'id'      => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'author'  => 'INT(10) NOT NULL',
            'content' => 'VARCHAR(255) NOT NULL',
            'film_id' => 'INT(10) NOT NULL',
            'book_id' => 'INT(10) NOT NULL',
            'game_id' => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_comments');
    }
}
