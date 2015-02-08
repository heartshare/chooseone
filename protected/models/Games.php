<?php

/**
 * Модель для таблиці "{{games}}".
 *
 * Атрибути нижче доступні для таблиці '{{games}}':
 * @property integer $id
 * @property string  $name
 * @property string  $description
 * @property string  $image
 * @property integer $created
 * @property integer $updated
 */
class Games extends CActiveRecord
{
    public $image;

    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{games}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('image', 'file', 'types' => 'jpg, png', 'allowEmpty' => true, 'on' => 'create, updates'),
            array('name, description, genre', 'required'),
            array('name', 'length', 'max' => 255),
            array('id, name, description, genre, image', 'safe', 'on' => 'search'),
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
            'screens'  => array(self::HAS_MANY,  'Screens',  'game_id'),
            'comments' => array(self::HAS_MANY,  'Comments', 'game_id'),
            'likes'    => array(self::BELONGS_TO,'Likes',    'game_id'),
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
            'image'       => 'Постер',
            'genre'       => 'Жанр',
            'created'     => 'Створено',
            'updated'     => 'Редаговано',
        );
    }

    /**
     * Пошук відповідного екземпляру(ів) за параметрами
     *
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Games the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Дія що виконується з екземпляром моделі після збереження
     *
     * @return mixed
     */
    public function afterSave()
    {
        $this->setIsNewRecord(false);
        if (isset($_FILES['screens'])) {
            $images = CUploadedFile::getInstancesByName('screens');
            if (isset($images) && count($images) > 0) {
                foreach ($images as $picture) {
                    $screens = new Screens;
                    $picture->saveAs(Yii::getPathOfAlias('webroot.images.games.screens') . DIRECTORY_SEPARATOR . $picture);
                    $screens->image = $picture->name;
                    $screens->game_id = $this->id;
                    $screens->save();
                }
            }
        }

        return parent::afterSave();
    }

    /**
     * Додаємо коментар до екземпляру моделі
     *
     * @param $comment
     * @return mixed
     */
    public function addComment($comment)
    {
        $comment->game_id = $this->id;

        return $comment->save();
    }

    /**
     * Забираємо всі коментарі для даного екземпляру
     *
     * @param $id
     * @return mixed
     */
    public function getComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->condition = 'game_id=' . $id;
        $comments = Comments::model()->findAll($criteria);

        return $comments;
    }

    /**
     * @return int
     */
    public function getUpVotes()
    {
        return count(Likes::model()->findAllByAttributes(array('game_id' => $this->id, 'up' => 1)));
    }

    /**
     * @return int
     */
    public function getDownVotes()
    {
        return count(Likes::model()->findAllByAttributes(array('game_id' => $this->id, 'down' => 1)));
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
