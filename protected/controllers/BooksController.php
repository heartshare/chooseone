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
            array('allow', // права для відвідувачів
                'actions' => array('index', 'view', 'ajax', 'search'),
                'users' => array('*'),
            ),
            array('allow', // права для адміністратора
                'actions' => array('admin', 'delete', 'create', 'update'),
                'roles' => array(2),
            ),
            array('deny', // права для всіх
                'users' => array('*'),
            ),
        );
    }

    /**
     * Відображення усіх книжок
     *
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
     * Відображаємо конкретну книжку по ID
     *
     * @param $id
     * @return mixed|string
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $comment = $this->newComment($model);

        return $this->render('view', array(
            'model'   => $model,
            'comment' => $comment,
        ));
    }

    /**
     * Обробляємо новий коментар для книжки
     *
     * @param $model
     * @return Comments
     */
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
     * Створення нової книжки
     *
     * @return mixed|string
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
     * Редагування уже існуючої книжки по ID
     *
     * @param $id
     * @return mixed|string
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
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Видаляємо книгу визначену за ID
     *
     * @param integer $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Аяксовий пошук відповідних книжок за жанром
     *
     * @return mixed|string
     */
    public function actionAjax()
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre=:genre';
        $criteria->params = array(':genre' => $_GET['genre']);
        $model = Books::model()->findAll($criteria);

        return $this->renderPartial('content', array('model' => $model));
    }

    /**
     * Пошук книжок за назвою
     *
     * @return mixed|null|string
     */
    public function actionSearch()
    {
        $response = null;
        if (isset($_GET['name'])) {
            $model = Books::model()->findAllByAttributes(array('name' => $_GET['name']));
            if ($model) {
                $response =  $this->renderPartial('content', array('model' => $model));
            } else {
                $response =  "За вашим запитом нічого не знайдено";
            }
        }

        return $response;
    }

    /**
     * Сторінка керування книжками для адміністратора
     *
     * @return mixed|string
     */
    public function actionAdmin()
    {
        $model = new Books('search');
        $model->unsetAttributes();
        if (isset($_GET['Books'])) {
            $model->attributes = $_GET['Books'];
        }

        return $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Повертає екземпляр моделі Books з вказаним ID параметром
     *
     * @param $id
     * @return CActiveRecord
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Books::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Книжки із вказаним ідентифікатором не існує');
        }

        return $model;
    }
}
