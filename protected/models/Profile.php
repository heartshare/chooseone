<?php

/**
 * Модель для таблиці "{{profile}}".
 *
 * Атрибути нижче доступні для таблиці '{{profile}}':
 * @property integer $id
 * @property string $photo
 * @property string $info
 * @property string $birth
 * @property integer $user_id
 * @property integer $ban
 */
class Profile extends CActiveRecord
{
    public $photo;

    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{profile}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('photo', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'on' => 'insert,update'),
            array('info', 'required'),
            array('id, photo, info, user_id', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id')
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'         => 'ID',
            'photo'      => 'Фото',
            'info'       => 'Інфо',
            'birth'      => 'Дата народження',
            'user_id'    => 'User',
            'registered' => 'Зареєстровано',
        );
    }

    /**
     * Пошук відповідного екземпляру(ів) за параметрами
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('photo', $this->photo, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('birth', $this->birth, true);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return Profile the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
