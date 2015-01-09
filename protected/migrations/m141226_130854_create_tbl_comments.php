<?php

class m141226_130854_create_tbl_comments extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_comments', array(
            'id'        => 'pk',
            'content'   => 'VARCHAR(255) NOT NULL',
            'film_id'   => 'INT(10) NOT NULL',
            'book_id'   => 'INT(10) NOT NULL',
            'game_id'   => 'INT(10) NOT NULL',
            'author_id' => 'INT(10) NOT NULL',
            'created'   => 'INT(10) NOT NULL',
            'updated'   => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_comments');
    }
}
