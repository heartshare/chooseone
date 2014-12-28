<?php

/**
 * This is the model class for table "{{profile}}".
 *
 * The followings are the available columns in table '{{profile}}':
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
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{profile}}';
    }

    /**
     * @return array validation rules for model attributes.
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
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'photo' => 'Фото',
            'info' => 'Інфо',
            'birth' => 'Зареєстровано',
            'user_id' => 'User',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
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
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Profile the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
