<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }


    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
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
        $this->render('contact', array('model' => $model));
    }

    public function actionAdmin()
    {
        $this->render('admin');
    }

    public function proccessComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'author_id=' . $id;
        $count = Comments::model()->count($criteria);
        $relator = new Relator;
        if ($count == 1) {
            $relator->user_id = $id;
            $relator->feed_id = 1;
        } else if ($count == 5) {
            $relator->user_id = $id;
            $relator->feed_id = 2;
        } else if ($count == 10) {
            $relator->user_id = $id;
            $relator->feed_id = 3;
        }
        $relator->save();
    }

    public function loadModel($id)
    {
        /* $criteria = new CDbCriteria;
         $criteria->condition = 'ban = :ban';
         $criteria->params = array(':ban'=>0);*/
        $model = Profile::model()->findByAttributes(array('user_id' => $id));
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
