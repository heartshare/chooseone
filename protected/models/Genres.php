<?php

/**
 * Модель для таблиці "{{genres}}".
 *
 * Наступні поля доступні для таблиці '{{genres}}':
 * @property integer $id
 * @property string $name
 */
class Genres extends CActiveRecord
{
    /**
     * @return string - асоційоване імя таблиці
     */
    public function tableName()
    {
        return '{{genres}}';
    }

    /**
     * @return array - правила валідації
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max' => 255),
            array('id, name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array - звязки
     */
    public function relations()
    {
        return array();
    }

    /**
     * @return array - назви атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'   => 'ID',
            'name' => 'Назва жанру',
        );
    }

    /**
     * Повертає список записів що відповідають критерії
     *
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Genres the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
