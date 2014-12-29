<?php

/**
 * Модель для таблиці "{{books}}".
 *
 * Атрибути нижче доступні для таблиці '{{books}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $book
 * @property string $image
 * @property string $date
 */
class Books extends CActiveRecord
{
    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{books}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('image', 'file', 'types' => 'jpg,png,gif', 'allowEmpty' => true, 'on' => 'insert, update'),
            array('book', 'file', 'types' => 'pdf', 'allowEmpty' => true, 'on' => 'insert, update'),
            array('name, description', 'required'),
            array('name, description', 'length', 'max' => 255),
            array('name', 'safe', 'on' => 'search'),
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
            'comments' => array(self::HAS_MANY, 'Comments', 'book_id')
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
            'author'      => 'Автор',
            'description' => 'Опис',
            'book'        => 'Книга',
            'genre'       => 'Жанр',
            'image'       => 'Картинка',
        );
    }

    /**
     * Пошук відповідного екземпляру(ів) за параметрами.
     *
     * @return CActiveDataProvider моделі що відповідають на умовам
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('book', $this->book, true);
        $criteria->compare('date', $this->date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр класу моделі
     *
     * @param string $className active record class name.
     * @return Books the static model class
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
        return parent::beforeSave();
    }

    /**
     * Додаємо до поточного екземпляру Books коментар
     *
     * @param $comment
     * @return mixed
     */
    public function addComment($comment)
    {
        $comment->book_id = $this->id;

        return $comment->save();
    }
}
