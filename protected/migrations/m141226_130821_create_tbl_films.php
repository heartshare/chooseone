<?php

class m141226_130821_create_tbl_films extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_films', array(
            'id'          => 'pk',
            'name'        => 'VARCHAR(255) NOT NULL',
            'description' => 'VARCHAR(255) NOT NULL',
            'genre'       => 'VARCHAR(255) NOT NULL',
            'vfile'       => 'VARCHAR(255) NOT NULL',
            'image'       => 'VARCHAR(255) NOT NULL',
            'created'     => 'INT(10) NOT NULL',
            'updated'     => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_films');
    }
}
