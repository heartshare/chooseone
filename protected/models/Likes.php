<?php

/**
 * Модель для таблиці "{{likes}}".
 *
 * Атрибути нижче доступні для таблиці '{{likes}}':
 * @property integer $id
 * @property integer $likes
 * @property integer $film_id
 * @property integer $game_id
 * @property integer $book_id
 */
class Likes extends CActiveRecord
{
    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{likes}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('likes, film_id, game_id, book_id', 'numerical', 'integerOnly' => true),
            array('id, likes, film_id, game_id, book_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Оголошення звязків з іншими моделями
     *
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'films' => array(self::BELONGS_TO, 'Films', 'film_id'),
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'      => 'ID',
            'likes'   => 'Likes',
            'film_id' => 'Film',
            'game_id' => 'Game',
            'book_id' => 'Book',
        );
    }

    /**
     * Пошук відповідного екземпляру(ів) за параметрами
     *
     * @return CActiveDataProvider моделі що відповідають на умовам
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
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Likes the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
