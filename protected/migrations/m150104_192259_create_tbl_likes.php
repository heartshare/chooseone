<?php

class m150104_192259_create_tbl_likes extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_likes', array(
            'id'      => 'pk',
            'up'      => 'INT(10) NOT NULL',
            'down'    => 'INT(10) NOT NULL',
            'film_id' => 'INT(10) NOT NULL',
            'game_id' => 'INT(10) NOT NULL',
            'book_id' => 'INT(10) NOT NULL',
            'user_id' => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_likes');
    }
}
