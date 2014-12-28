<?php

class m141226_130803_create_tbl_books extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_books', array(
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'author' => 'VARCHAR(255) NOT NULL',
            'book' => 'VARCHAR(255) NOT NULL',
            'image' => 'VARCHAR(255) NOT NULL',
            'genre' => 'VARCHAR(255) NOT NULL',
            'date' => 'VARCHAR(255) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_books');
    }
}
