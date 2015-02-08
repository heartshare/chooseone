<?php

class m150208_141210_create_tbl_genre_content extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_genre_content', array(
            'id'        => 'pk',
            'genre_id'  => 'INT(11) DEFAULT NULL',
            'book_id'   => 'INT(11) DEFAULT NULL',
            'film_id'   => 'INT(11) DEFAULT NULL',
            'game_id'   => 'INT(11) DEFAULT NULL',

        ));
    }

    public function down()
    {
        $this->dropTable('tbl_genre_content');
    }
}
