<?php

/**
 * Модель для таблиці "{{user}}".
 *
 * Атрибути нижче доступні для таблиці '{{user}}':
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property integer $role
 */
class User extends CActiveRecord
{
    const ROLE_ADMIN = 2;
    const ROLE_USER = 1;

    /**
     * @return string імя таблиці
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array правила валідації для атрибутів моделі
     */
    public function rules()
    {
        return array(
            array('login, password, email', 'required'),
            array('email', 'email'),
            array('login, password, email', 'length', 'max' => 255),
            array('id, login, password, email, role', 'safe'),
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
            'profile'  => array(self::HAS_ONE,    'Profile',  'user_id'),
            'comments' => array(self::HAS_MANY,   'Comments', 'author_id'),
            'feed'     => array(self::MANY_MANY,  'Feed',     'tbl_relator(user_id, feed_id)'),
            'likes'    => array(self::BELONGS_TO, 'Likes',    'user_id'),
        );
    }

    /**
     * @return array лейбли для атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'id'       => 'ID',
            'login'    => 'Логін',
            'password' => 'Пароль',
            'email'    => 'Пошта',
            'role'     => 'Роль',
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
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Повертає екземпляр моделі
     *
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Виконуємо дію над екзмепляром до збередення
     *
     * @return bool
     */
    public function beforeSave()
    {
        if ($this->isNewRecord && (count(Books::model()->findAll()) == 0)) {
            $this->role = 1;
            $this->password = md5($this->password);
        }

        return parent::beforeSave();
    }

    /**
     * Виконуємо дію над екзмепляром після збередення
     *
     * @throws CHttpException
     */
    public function afterSave()
    {
        if ($this->isNewRecord) {
            $profile = new Profile;
            $profile->photo = 'no_avatar.png';
            $profile->info = 'Про вас';
            $profile->ban = 0;
            $profile->user_id = $this->id;
            if ($profile->validate() == false) {
                throw new CHttpException(404);
            } else {
                $profile->save();
            }
        }

        return parent::afterSave();
    }

    /**
     * Рахуємо кількість коментарів для даного автора
     *
     * @param $id
     * @return string
     */
    public function countComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'author_id=' . $id;
        $count = Comments::model()->count($criteria);

        return $count;
    }
}
