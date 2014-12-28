<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $email
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 'administrator';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('login, password, email', 'required'),
            array('login, password, email', 'length', 'max' => 255),
            array('id, login, password, email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * behavior for MANY_TO_MANY
     */
    public function behaviors()
    {
        return array('ESaveRelatedBehavior' => array(
            'class' => 'application.components.ESaveRelatedBehavior')
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
            'comments' => array(self::HAS_MANY, 'Comments', 'author_id'),
            'feed' => array(self::MANY_MANY, 'Feed', 'tbl_relator(user_id, feed_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Логін',
            'password' => 'Пароль',
            'email' => 'Пошта',
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
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $this->role = 1;
            $this->password = md5($this->password);
        }

        return parent::beforeSave();
    }

    public function afterSave()
    {
        $profile = new Profile;
        $profile->photo = 'no_avatar.png';
        $profile->info = 'Про вас';
        $profile->ban = 0;
        $profile->user_id = $this->id;
        if ($profile->validate() == false) {
            throw new CHttpException(404, 'Fuck');
        } else {
            $profile->save();
        }
    }

    public function countComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'author_id=' . $id;
        $count = Comments::model()->count($criteria);

        return $count;
    }
}
