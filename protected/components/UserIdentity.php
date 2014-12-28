<?php

/**
 * Клас що перевіряє чи зареєстровано користувача
 * і чи має він право увіти в систему.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $_role;

    /**
     * Проводимо аутентифікацію користувача
     *
     * @return mixed
     */
    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('login' => $this->username));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$record->password == md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $record->id;
            $this->_role = $record->role;
            $this->errorCode = self::ERROR_NONE;
        }

        return $this->errorCode;
    }

    /**
     * Повертаємо ідентифікатор користувача(по замовчуванню функція повертає username)
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Повертаємо роль користувача
     *
     * @return mixed
     */
    public function getRole()
    {
        return $this->_role;
    }
}
