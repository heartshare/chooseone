<?php

/**
 * Контролер відповідальний за операції повязані з користувачем та його профілем у системі
 */
class UserController extends Controller
{

    /**
     * Права доступу до дій контролера
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('registration', 'view', 'login', 'logout'),
                'users'   => array('*'),
            ),
            array('allow',
                'actions' => array('dashboard', 'admin', 'ban', 'unban', 'edit'),
                'users'   => array(Yii::app()->user->name),
                'roles'   => array(2),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Реєстрація користувача в системі
     *
     * @return string|void
     */
    public function actionRegistration()
    {
        $model = new User;
        if (isset($_POST['User'])) {
            $user = User::model()->findByAttributes(array('login' => $_POST['User']['login']));
            if ($user) {
                Yii::app()->user->setFlash('login', 'Користувач з таким логіном вже існує');

                return $this->refresh();
            } else {
                $model->attributes = $_POST['User'];
                if ($model->save()) {
                    $login = new LoginForm;
                    $login->username = $_POST['User']['login'];
                    $login->password = $_POST['User']['password'];
                    if ($login->validate() && $login->login()) {
                        Yii::app()->user->setFlash('registered', 'Дякуємо за реєстрацію на нашому сайті!');

                        return $this->redirect($this->createUrl('site/index'));
                    } else {
                        return $login->getErrors();
                    }
                }
            }
        }

        return $this->render('registration', array('model' => $model));
    }

    /**
     * Бан користувача
     */
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

    /**
     * Відміна бану користувача
     */
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

    /**
     * Перегляд профілю користувача
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id, Profile::model());
        $this->proccessComments($id);

        return $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Обробка кількості коментарів користувача,
     * та в залежності від кількості надання користуачеві відзнаки
     *
     * @param $id
     */
    public function proccessComments($id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'author_id = :id';
        $criteria->params = array('id' => $id);
        $count = Comments::model()->count($criteria);
        $relator = new Relator;
        if ((Relator::model()->findByAttributes(array('user_id' => $id, 'feed_id' => 1)) == null)
            && ($count == 1 || $count < 5)) {
            $relator->user_id = $id;
            $relator->feed_id = 1;
        } else if ((Relator::model()->findByAttributes(array('user_id' => $id, 'feed_id' => 2)) == null)
            && ($count == 5 || ($count < 10 && $count > 5))) {
            $relator->user_id = $id;
            $relator->feed_id = 2;
        } else if ((Relator::model()->findByAttributes(array('user_id' => $id, 'feed_id' => 3)) == null)
            && ($count == 10)) {
            $relator->user_id = $id;
            $relator->feed_id = 3;
        }
        $relator->save();
//        var_dump($relator->getErrors());die;
    }

    /**
     * Редагування профілю
     *
     * @return string
     */
    public function actionEdit()
    {
        $model = Profile::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        if (isset($_POST['Profile'])) {
            $model->attributes = $_POST['Profile'];
            $document = CUploadedFile::getInstance($model, 'photo');
            $model->photo = $document;
            if ($model->save()) {
                if (null != $document) {
                    $document->saveAs(Yii::getPathOfAlias('webroot.images.profile') . DIRECTORY_SEPARATOR . $document);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        return $this->render('edit', array(
            'model' => $model,
        ));
    }

    /**
     * Відображення та обробка форми логіну
     *
     * @return string
     */
    public function actionLogin()
    {
        $model = new LoginForm;
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        return $this->render('login', array('model' => $model));
    }

    /**
     * Вихід користувача із системи
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Керування користувачами
     *
     * @return string
     */
    public function actionAdmin()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User'])) {
            $model->attributes = $_GET['User'];
        }

        return $this->render('users', array(
            'model' => $model,
        ));
    }

    /**
     * Відображає панель адміністрування усіма розділами
     *
     * @return mixed|string
     */
    public function actionDashboard()
    {
        return $this->render('admin');
    }
}
