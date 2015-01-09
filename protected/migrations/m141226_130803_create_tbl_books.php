<?php

class m141226_130803_create_tbl_books extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_books', array(
            'id'          => 'pk',
            'name'        => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'author'      => 'VARCHAR(255) NOT NULL',
            'book'        => 'VARCHAR(255) NOT NULL',
            'image'       => 'VARCHAR(255) NOT NULL',
            'genre'       => 'VARCHAR(255) NOT NULL',
            'created'     => 'INT(10) NOT NULL',
            'updated'     => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_books');
    }
}
