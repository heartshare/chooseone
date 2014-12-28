<?php

class UserController extends Controller
{

    public function actionRegistration()
    {
        $model = new User;
        if (isset($_POST['User'])) {
            $user = User::model()->findByAttributes(array('login' => $_POST['User']['login']));
            if ($user) {
                Yii::app()->user->setFlash('login', 'Користувач з таким логіном вже існує');
                $this->refresh();
            } else {
                $model->attributes = $_POST['User'];
                $model->save();
                $this->redirect('login');
            }
        }
        $this->render('registration', array('model' => $model));
    }

    public function actionUsers()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('users', array(
            'model' => $model,
        ));
    }

    public function actionBan()
    {
        if (isset($_GET['id'])) {
            $model = Profile::model()->findByAttributes(array('id' => $_GET['id']));
            $model->ban = 1;

            if ($model->save()) {
                echo "<h3>Користувач забанений!</h3>";

            }
        }
    }

    public function actionUnBan()
    {
        if (isset($_GET['id'])) {

            $model = Profile::model()->findByAttributes(array('id' => $_GET['id']));
            $model->ban = 0;

            if ($model->save()) {
                echo "<h3>Користувач розбанений!</h3>";

            }
        }
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $user = new User();
        // $profit=$user->countComments($id);
        $this->proccessComments($id);
        $this->render('view', array(
            'model' => $model,
            //  'profit'=>$profit,
        ));
        //}
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

    public function actionEdit()
    {
        $model = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            $document = CUploadedFile::getInstance($model, 'photo');
            $model->photo = $document;
            if ($model->save()) {
                $document->saveAs(Yii::getPathOfAlias('webroot.images.profile') . DIRECTORY_SEPARATOR . $document);
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('edit', array(
            'model' => $model,
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}