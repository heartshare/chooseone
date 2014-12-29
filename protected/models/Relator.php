<?php

/**
 * Модель для таблиці "{{relator}}".
 *
 * Атрибути нижче доступні для таблиці '{{relator}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $feed_id
 */
class Relator extends CActiveRecord
{

    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{relator}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('user_id, feed_id', 'required'),
            array('user_id, feed_id', 'numerical', 'integerOnly' => true),
            array('id, user_id, feed_id', 'safe', 'on' => 'search'),
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
        return array();
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'feed_id' => 'Feed',
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
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('feed_id', $this->feed_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Relator the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
