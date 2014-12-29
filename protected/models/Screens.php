<?php

/**
 * Модель для таблиці "{{screens}}".
 *
 * Атрибути нижче доступні для таблиці '{{screens}}':
 * @property integer $id
 * @property string $image
 * @property integer $game_id
 */
class Screens extends CActiveRecord
{

    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{screens}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('image', 'file', 'types' => 'jpg, png, jpeg', 'on' => 'create, update'),
            array('game_id', 'numerical', 'integerOnly' => true),
            array('id, image, game_id', 'safe', 'on' => 'search'),
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
            'game' => array(self::BELONGS_TO, 'Games', 'game_id')
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'      => 'ID',
            'image'   => 'Image',
            'game_id' => 'Game',
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
        $criteria->compare('image', $this->image, true);
        $criteria->compare('game_id', $this->game_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Screens the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
