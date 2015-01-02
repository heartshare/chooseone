<?php

class FilmsController extends Controller
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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => array(Yii::app()->user->getName()),
                'roles' => array(2),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $count = Films::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = Films::model()->findAll($criteria);

        return $this->render('index', array(
            'model' => $model,
            'pages' => $pages,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $comment = $this->newComment($model);

        $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
            'comments' => $model->getComments($id),

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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Films;
        if (isset($_POST['Films'])) {
            $model->attributes = $_POST['Films'];
            $document = CUploadedFile::getInstance($model, 'image');
            $video = CUploadedFile::getInstance($model, 'vfile');
            $model->image = $document;
            $model->vfile = $video;
            if ($model->save()) {
                if (null != $document) {
                    $document->saveAs(Yii::getPathOfAlias('webroot.images.films') . DIRECTORY_SEPARATOR . $document);
                }
                if (null != $video) {
                    $video->saveAs(Yii::getPathOfAlias('webroot.uploads.videos') . DIRECTORY_SEPARATOR . $video);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }

        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Films'])) {
            $model->attributes = $_POST['Films'];
            $document = CUploadedFile::getInstance($model, 'image');
            $video = CUploadedFile::getInstance($model, 'vfile');
            $model->image = $document;
            $model->vfile = $video;
            if ($model->save())
                $document->saveAs(Yii::getPathOfAlias('webroot.images.films') . DIRECTORY_SEPARATOR . $document);
            $video->saveAs(Yii::getPathOfAlias('webroot.uploads.videos') . DIRECTORY_SEPARATOR . $video);
            $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }


    public function actionAjax()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre= :genre';
        $criteria->params = array(":genre" => $_GET['genre']);
        $model = Films::model()->findAllByAttributes(array('genre' => $_GET['genre']), $criteria);
        $this->renderPartial('content', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Films('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Films']))
            $model->attributes = $_GET['Films'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionSearch()
    {
        if (isset($_GET['name'])) {
            $model = Films::model()->findAllByAttributes(array('name' => $_GET['name']));
            if ($model) {
                $this->renderPartial('content', array('model' => $model));
            } else {
                echo "<h3>За вашим запитом нічого не знайдено</h3>";
            }
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Films the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Films::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Films $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'films-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
