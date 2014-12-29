<?php

class GamesController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'ajax', 'search'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => array(Yii::app()->user->name),
                'roles' => array(2),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
            'comment' => $this->newComment($model),
            'comments' => $model->getComments($id)
        ));
    }

    protected function newComment($model)
    {
        $comment = new Comments;
        if (isset($_POST['Comments'])) {
            $comment->attributes = $_POST['Comments'];
            if ($model->addComment($comment)) {
                Yii::app()->user->setFlash('commentSubmitted', 'Дякуємо за ваш коментар.
            Залишайтесь з нами.');
                $this->refresh();
            }
        }

        return $comment;
    }


    public function actionCreate()
    {
        $model = new Games;
        $screens = new Screens;
        if (isset($_POST['Games'])) {
            $model->attributes = $_POST['Games'];
            $doc = CUploadedFile::getInstance($model, 'image');
            $model->image = $doc;
            if ($model->save()) {
                if (null != $doc) {
                    $doc->saveAs(Yii::getPathOfAlias('webroot.images.games') . DIRECTORY_SEPARATOR . $doc);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('create', array(
            'model' => $model,
            'screens' => $screens
        ));
    }


    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        Screens::model()->deleteAllByAttributes(array('game_id' => $id));
        $screens = new Screens;
        if (isset($_POST['Games'])) {
            $model->attributes = $_POST['Games'];
            $doc = CUploadedFile::getInstance($model, 'image');
            $model->image = $doc;
            if ($model->save()) {
                if (null != $doc) {
                    $doc->saveAs(Yii::getPathOfAlias('webroot.images.games') . DIRECTORY_SEPARATOR . $doc);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('update', array(
            'model' => $model,
            'screens' => $screens
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
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

        $this->render('index', array('model' => $model, 'pages' => $pages));
    }

    public function actionAjax()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre=:genre';
        $criteria->params = array(':genre' => $_GET['genre']);
        $model = Games::model()->findAll($criteria);

        $this->renderPartial('content', array('model' => $model));
    }

    public function actionSearch()
    {
        if (isset($_GET['name'])) {
            $model = Games::model()->findAllByAttributes(array('name' => $_GET['name']));
            if ($model) {
                $this->renderPartial('content', array('model' => $model));
            } else {
                echo "<h3>За вашим запитом нічого не знайдено</h3>";
            }
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Games('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Games']))
            $model->attributes = $_GET['Games'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Games the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Games::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Games $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'games-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
