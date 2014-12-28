<?php

/**
 * Класс що відображає користувача
 */
class WebUser extends CWebUser
{

    private $_model = null;

    /**
     * Повертаємо роль користувача
     *
     * @return mixed
     */
    function getRole()
    {
        if ($user = $this->getModel()) {
            return $user->role;
        }
    }

    /**
     * Знаходимо користувача за заданими параметрами
     *
     * @return null
     */
    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }

        return $this->_model;
    }
}
