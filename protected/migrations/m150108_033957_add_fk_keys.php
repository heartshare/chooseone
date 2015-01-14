<?php

class m150108_033957_add_fk_keys extends CDbMigration
{
    public function up()
    {
        $this->addForeignKey('FK_user_profile',    'tbl_profile',  'user_id',   'tbl_user',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_books_comments',  'tbl_comments', 'book_id',   'tbl_books', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_films_comments',  'tbl_comments', 'film_id',   'tbl_films', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_games_comments',  'tbl_comments', 'game_id',   'tbl_games', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_author_comments', 'tbl_comments', 'author_id', 'tbl_user',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_books_likes',     'tbl_likes',    'book_id',   'tbl_books', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_games_likes',     'tbl_likes',    'game_id',   'tbl_games', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_user_likes',      'tbl_likes',    'user_id',   'tbl_user',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_games_screens',   'tbl_screens',  'game_id',   'tbl_games', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_feed_user_1',     'tbl_relator',  'user_id',   'tbl_user',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_feed_user_2',     'tbl_relator',  'feed_id',   'tbl_feed',  'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_films_likes',     'tbl_likes',    'film_id',   'tbl_films', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_profile',    'tbl_profile');
        $this->dropForeignKey('FK_books_comments',  'tbl_comments');
        $this->dropForeignKey('FK_films_comments',  'tbl_comments');
        $this->dropForeignKey('FK_games_comments',  'tbl_comments');
        $this->dropForeignKey('FK_author_comments', 'tbl_comments');
        $this->dropForeignKey('FK_books_likes',     'tbl_likes');
        $this->dropForeignKey('FK_films_likes',     'tbl_likes');
        $this->dropForeignKey('FK_games_likes',     'tbl_likes');
        $this->dropForeignKey('FK_user_likes',      'tbl_likes');
        $this->dropForeignKey('FK_games_screens',   'tbl_screens');
        $this->dropForeignKey('FK_games_screens',   'tbl_screens');
        $this->dropForeignKey('FK_feed_user_1',     'tbl_relator');
        $this->dropForeignKey('FK_feed_user_2',     'tbl_relator');
    }
}
