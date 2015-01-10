<?php

class m141226_130854_create_tbl_comments extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_comments', array(
            'id'        => 'pk',
            'content'   => 'VARCHAR(255) NOT NULL',
            'film_id'   => 'INT(11) DEFAULT NULL',
            'book_id'   => 'INT(11) DEFAULT NULL',
            'game_id'   => 'INT(11) DEFAULT NULL',
            'author_id' => 'INT(11) NOT NULL',
            'created'   => 'INT(10) NOT NULL',
            'updated'   => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_comments');
    }
}
