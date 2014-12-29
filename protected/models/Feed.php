<?php

/**
 * Модель для таблиці "{{feed}}".
 *
 * Атрибути нижче доступні для таблиці '{{feed}}':
 * @property integer $id
 * @property string $picture
 * @property string $description
 */
class Feed extends CActiveRecord
{
    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{feed}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('picture, description', 'required'),
            array('picture, description', 'length', 'max' => 255),
            array('id, picture, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * Поведінка для збереження звязаних моделей по типу звязку MANY_TO_MANY
     *
     * @return array
     */
    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.components.ESaveRelatedBehavior')
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
            'user' => array(self::MANY_MANY, 'User', 'tbl_relator(feed_id, user_id)'),
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'          => 'ID',
            'picture'     => 'Картинка',
            'description' => 'Опис',
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
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Feed the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
