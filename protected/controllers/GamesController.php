<?php

class GamesController extends Controller
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
                'actions' => array('index', 'view', 'ajax', 'search'),
                'users'   => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users'   => array(Yii::app()->user->name),
                'roles'   => array(2),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Відображення усіх ігор
     *
     * @return string
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = Games::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = Games::model()->findAll($criteria);

        return $this->render('index', array('model' => $model, 'pages' => $pages));
    }

    /**
     * Відображення конкретного екземпляру по ID
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id, Games::model());

        return $this->render('view', array(
            'model'    => $model,
            'comment'  => $this->newComment($model),
            'comments' => $model->getComments($id)
        ));
    }

    /**
     * Додавання нової гри
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Games;
        $screens = new Screens;
        if (isset($_POST['Games'])) {
            $model->attributes = $_POST['Games'];
            $poster = CUploadedFile::getInstance($model, 'image');
            $model->image = $poster;
            if ($model->save()) {
                if (null != $poster) {
                    $poster->saveAs(Yii::getPathOfAlias('webroot.images.games') . DIRECTORY_SEPARATOR . $poster);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('create', array(
            'model'   => $model,
            'screens' => $screens
        ));
    }


    /**
     * Редагування існуючої гри по ID
     *
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, Games::model());
        Screens::model()->deleteAllByAttributes(array('game_id' => $id));
        $screens = new Screens;
        if (isset($_POST['Games'])) {
            $model->attributes = $_POST['Games'];
            $poster = CUploadedFile::getInstance($model, 'image');
            $model->image = $poster;
            if ($model->save()) {
                if (null != $poster) {
                    $poster->saveAs(Yii::getPathOfAlias('webroot.images.games') . DIRECTORY_SEPARATOR . $poster);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('update', array(
            'model'   => $model,
            'screens' => $screens
        ));
    }

    /**
     * Видалення конкретної гри по ID
     *
     * @param integer $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id, Games::model())->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Аяксовий пошук відповідних ігор за жанром
     *
     * @return string
     */
    public function actionAjax()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre=:genre';
        $criteria->params = array(':genre' => $_GET['genre']);
        $count = Games::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = Games::model()->findAll($criteria);

        return $this->renderPartial('content', array('model' => $model, 'pages' => $pages));
    }

    /**
     * Пошук ігор за назвою
     *
     * @return null|string
     */
    public function actionSearch()
    {
        $response = null;
        if (isset($_GET['name'])) {
            $model = Games::model()->findAllByAttributes(array('name' => $_GET['name']));
            if ($model) {
                $response = $this->renderPartial('content', array('model' => $model));
            } else {
                $response = 'За вашим запитом нічого не знайдено';
            }
        }

        return $response;
    }

    /**
     * Сторінка керування іграми для адміністратора
     *
     * @return mixed|string
     */
    public function actionAdmin()
    {
        $model = new Games('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Games'])) {
            $model->attributes = $_GET['Games'];
        }

        return $this->render('admin', array(
            'model' => $model,
        ));
    }
}
