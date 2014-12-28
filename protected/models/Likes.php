<?php

/**
 * This is the model class for table "{{likes}}".
 *
 * The followings are the available columns in table '{{likes}}':
 * @property integer $id
 * @property integer $likes
 * @property integer $film_id
 * @property integer $game_id
 * @property integer $book_id
 */
class Likes extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{likes}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('likes, film_id, game_id, book_id', 'numerical', 'integerOnly' => true),
            array('id, likes, film_id, game_id, book_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'films' => array(self::BELONGS_TO, 'Films', 'film_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'likes' => 'Likes',
            'film_id' => 'Film',
            'game_id' => 'Game',
            'book_id' => 'Book',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('likes', $this->likes);
        $criteria->compare('film_id', $this->film_id);
        $criteria->compare('game_id', $this->game_id);
        $criteria->compare('book_id', $this->book_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Likes the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
