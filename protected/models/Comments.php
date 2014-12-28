<?php

/**
 * Модель для таблиці "{{comments}}".
 *
 * Атрибути нижче доступні для таблиці '{{comments}}':
 * @property integer $id
 * @property string $author
 * @property string $content
 * @property integer $film_id
 * @property integer $book_id
 * @property integer $game_id
 */
class Comments extends CActiveRecord
{
    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{comments}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('content', 'required'),
            array('id, author, content, film_id, book_id, game_id', 'safe', 'on' => 'search'),
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
            'films'  => array(self::BELONGS_TO, 'Films', 'film_id'),
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
            'books'  => array(self::BELONGS_TO, 'Books', 'book_id'),
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'      => 'ID',
            'author'  => 'Автор',
            'content' => 'Контент',
            'film_id' => 'Фільм',
            'book_id' => 'Книга',
            'game_id' => 'Гра',
        );
    }

    /**
     * Пошук відповідного коментаря за параметрами.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('author', $this->author, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('film_id', $this->film_id);
        $criteria->compare('book_id', $this->book_id);
        $criteria->compare('game_id', $this->game_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр класу моделі
     *
     * @param string $className active record class name.
     * @return Comments the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Виконуємо дії перед збереженням в базу даних
     *
     * @return mixed
     */
    public function beforeSave()
    {
        $this->date = time();
        $this->author = Yii::app()->user->getName();
        $this->author_id = Yii::app()->user->id;

        return parent::beforeSave();
    }
}
