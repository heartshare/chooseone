<?php

class SiteController extends Controller
{

    /**
     * Оголошуємо сторонні actions необхідні для логіки даного контроллеру
     */
    public function actions()
    {
        return array(
            'captcha' => array( // рендерить картинку з капчею на сторінці контакту
                'class'     => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Головна сторінка
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    /**
     * Обробка та вивід виключних ситуацій(помилок)
     *
     * @return string
     */
    public function actionError()
    {
        $response = 'error-message';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                $response = $error['message'];
            } else {
                if ($error['code'] === 404) {
                    $response = $this->renderPartial('error', $error);
                } else {
                    $response = $this->render('error', $error);
                }
            }
        }

        return $response;
    }

    /**
     * Сторінка зворотнього звязку
     *
     * @return string|void
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

                return $this->refresh();
            }
        }

        return $this->render('contact', array('model' => $model));
    }
}
