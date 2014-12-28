<?php

class m141227_183517_create_tbl_relator extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_relator', array(
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'user_id' => 'INT(10) NOT NULL',
            'feed_id' => 'INT(10) NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_comments');
    }
}
