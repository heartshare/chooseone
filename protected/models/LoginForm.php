<?php

/**
 * Даний клас призначений для зберігання даних користувача з форми входу.
 * Використовується в UserController->actionLogin()
 */
class LoginForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Правила валідації для полів форми логіну
     */
    public function rules()
    {
        return array(
            array('username, password', 'required'), // логін та пароль обовязкові
            array('rememberMe', 'boolean'), // "запамятати" вовинен бути булевого типу
            array('password', 'authenticate'), // пароль повинен бути аутентифікованим
        );
    }

    /**
     * Лейбли атрибутів
     */
    public function attributeLabels()
    {
        return array(
            'username' => 'Логін',
            'password' => 'Пароль',
            'rememberMe' => 'Запамятати мене',
        );
    }

    /**
     * Перевірка на аутентифікацію. Це 'authenticate' валідатор оголошений у методі rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if ($this->_identity->authenticate() == UserIdentity::ERROR_USERNAME_INVALID) {
                $this->addError('username', 'Логін невірний.');
            } else if ($this->_identity->authenticate() == UserIdentity::ERROR_PASSWORD_INVALID) {
                $this->addError('password', 'Пароль невірний.');
            }
        }
    }

    /**
     * Преревіряє на правильність введені дані користувача
     * @return boolean
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 днів
            Yii::app()->user->login($this->_identity, $duration);

            return true;
        } else {

            return false;
        }
    }
}
