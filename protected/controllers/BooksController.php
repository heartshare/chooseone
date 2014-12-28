<?php

/**
 * Контролер що відповідає за логіку роботи з книжками, в тому числі і з моделлю для книг
 */
class BooksController extends Controller
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
                'actions' => array('admin', 'delete', 'create', 'update'),
                'roles' => array(2),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = "id DESC";
        $count = Books::model()->count();
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = Books::model()->findAll($criteria);

        return $this->render('index', array(
            'model' => $model,
            'pages' => $pages
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

        return $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
        ));
    }

    protected function newComment($model)
    {
        $comment = new Comments;
        if (isset($_POST['Comments'])) {
            $comment->attributes = $_POST['Comments'];
            if ($model->addComment($comment)) {
                Yii::app()->user->setFlash('commentSubmitted', 'Дякуємо за ваш коментар. Залишайтесь з нами.');
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
        $model = new Books;
        if (isset($_POST['Books'])) {
            $model->attributes = $_POST['Books'];
            $image = CUploadedFile::getInstance($model, 'image');
            $book = CUploadedFile::getInstance($model, 'book');
            $model->image = $image;
            $model->book = $book;
            if ($model->save()) {
                if (null != $image) {
                    $image->saveAs(Yii::getPathOfAlias('webroot.images.books') . DIRECTORY_SEPARATOR . $image);
                }
                if (null != $book) {
                    $book->saveAs(Yii::getPathOfAlias('webroot.uploads.books') . DIRECTORY_SEPARATOR . $book);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('create', array(
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
        if (isset($_POST['Books'])) {
            $model->attributes = $_POST['Books'];
            $image = CUploadedFile::getInstance($model, 'image');
            $book = CUploadedFile::getInstance($model, 'book');
            $model->image = $image;
            $model->book = $book;
            if ($model->save()) {
                if (null != $image) {
                    $image->saveAs(Yii::getPathOfAlias('webroot.images.books') . DIRECTORY_SEPARATOR . $image);
                }
                if (null != $book) {
                    $book->saveAs(Yii::getPathOfAlias('webroot.uploads.books') . DIRECTORY_SEPARATOR . $book);
                }

                return $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('update', array(
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
        $this->loadModel($_GET['id'])->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAjax()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre=:genre';
        $criteria->params = array(':genre' => $_GET['genre']);
        $model = Books::model()->findAll($criteria);

        $this->renderPartial('content', array('model' => $model));
    }

    public function actionSearch()
    {
        if (isset($_GET['name'])) {
            $model = Books::model()->findAllByAttributes(array('name' => $_GET['name']));
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
        $model = new Books('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Books']))
            $model->attributes = $_GET['Books'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Books the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Books::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Books $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'books-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
