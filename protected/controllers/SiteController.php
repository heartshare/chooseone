<?php

class SiteController extends Controller
{

    /**
     * Оголошуємо сторонні actions необхідні для логіки даного контроллеру
     */
    public function actions()
    {
        return array(
            'captcha' => array( // captcha action renders the CAPTCHA image displayed on the contact page
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Головна сторінка
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Обробка та вивід виключних ситуацій(помилок)
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {

                return $error['message'];
            } else {

                return $this->render('error', $error);
            }
        }
    }

    /**
     * Сторінка зворотнього звязку
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Дякуємо що звязались з нами. Відповімо як тільки буде можливість.');
                $this->refresh();
            }
        }

        return $this->render('contact', array('model' => $model));
    }
}
