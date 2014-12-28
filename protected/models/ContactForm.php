<?php

/**
 * Клас що представляє контактну форму
 */
class ContactForm extends CFormModel
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * Правила валідації
     */
    public function rules()
    {
        return array(
            array('name, email, subject, body', 'required'),
            array('email', 'email'),
            array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Лейбли атрибутів що відображаються на формі
     */
    public function attributeLabels()
    {
        return array(
            'name'       => 'Імя',
            'email'      => 'Пошта',
            'subject'    => 'Тема',
            'body'       => 'Лист',
            'verifyCode' => 'Код перeвірки',
        );
    }
}
