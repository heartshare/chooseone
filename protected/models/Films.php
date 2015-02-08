<?php

/**
 * Модель для таблиці "{{films}}".
 *
 * Атрибути нижче доступні для таблиці '{{films}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $vfile
 * @property string $image
 * @property string $genre
 * @property integer $created
 * @property integer $updated
 */
class Films extends CActiveRecord
{
    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{films}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('image', 'file', 'types' => 'jpg, png, gif', 'allowEmpty' => true, 'on' => 'insert, update'),
            array('vfile', 'file', 'types' => 'mp4', 'maxSize' => 150 * 1024 * 1024, 'allowEmpty' => true, 'on' => 'insert, update'),
            array('name, description, genre', 'required'),
            array('id, name, description, genre', 'safe', 'on' => 'search'),
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
            'comments' => array(self::HAS_MANY,   'Comments', 'film_id'),
            'likes'    => array(self::BELONGS_TO, 'Likes',    'film_id'),
        );
    }

    /**
     * Поведінки моделі
     *
     * @return array
     */
    public function behaviors()
    {
        return array(
            'timestamps' => array( // автоматичне заповнення полів дат створення та редагування
                'class'             => 'zii.behaviors.CTimestampBehavior',
                'createAttribute'   => 'created',
                'updateAttribute'   => 'updated',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'          => 'ID',
            'name'        => 'Назва',
            'description' => 'Опис',
            'vfile'       => 'Відео',
            'image'       => 'Постер',
            'genre'       => 'Жанр',
            'created'     => 'Створено',
            'updated'     => 'Редаговано',
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
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('vfile', $this->vfile, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Films the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Додаємо коментар
     *
     * @param $comment
     * @return mixed
     */
    public function addComment($comment)
    {
        $comment->film_id = $this->id;

        return $comment->save();
    }

    /**
     * Отримуємо всі коментарі для даного фільму
     *
     * @param $id
     * @return CActiveRecord[]
     */
    public function getComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'film_id=' . $id;
        $criteria->order = 'id DESC';
        $comments = Comments::model()->findAll($criteria);

        return $comments;
    }

    /**
     * @return int
     */
    public function getUpVotes()
    {
        return count(Likes::model()->findAllByAttributes(array('film_id' => $this->id, 'up' => 1)));
    }

    /**
     * @return int
     */
    public function getDownVotes()
    {
        return count(Likes::model()->findAllByAttributes(array('film_id' => $this->id, 'down' => 1)));
    }

    /**
     * @return bool|void
     */
    public function beforeSave()
    {
        if (null == $this->image) {
            $this->image = 'no_picture.png';
        }

        return parent::beforeSave();
    }
}
