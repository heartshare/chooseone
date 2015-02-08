<?php

class m150208_141123_create_tbl_genres extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_genres', array(
            'id'   => 'pk',
            'name' => 'VARCHAR(255)'
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_genres');
    }
}
