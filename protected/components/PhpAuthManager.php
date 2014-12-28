<?php

/**
 * Class PhpAuthManager
 */
class PhpAuthManager extends CPhpAuthManager
{
    /**
     * Функція ініціалізації
     */
    public function init()
    {
        // підключаємо файл з їєрархією ролей із папки config додатку
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';
        }
        parent::init();
        if (!Yii::app()->user->isGuest) { // перевіряємо чи не користувач не гість
            // свзязуємо роль з ідентифікатором користувача, який повертається UserIdentity.getId()
            $this->assign(Yii::app()->user->role, Yii::app()->user->id);
        }
    }
}
