<?php

class m150104_192259_create_tbl_likes extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_likes', array(
            'id'      => 'pk',
            'up'      => 'INT(10) NOT NULL DEFAULT 0',
            'down'    => 'INT(10) NOT NULL DEFAULT 0',
            'film_id' => 'INT(11) DEFAULT NULL',
            'game_id' => 'INT(11) DEFAULT NULL',
            'book_id' => 'INT(11) DEFAULT NULL',
            'user_id' => 'INT(11) DEFAULT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_likes');
    }
}
