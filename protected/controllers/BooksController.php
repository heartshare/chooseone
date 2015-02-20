<?php

/**
 * Контролер що відповідає за логіку роботи з книжками, в тому числі і з моделлю для книг
 */
class BooksController extends Controller
{

    /**
     * Фільтри для дій контролера
     *
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            'ajaxOnly + rating',
            array(
                'CHttpCacheFilter + index',
                'lastModified' => Yii::app()->db->createCommand("SELECT MAX(`updated`) FROM {{books}}")->queryScalar(),
            ),
        );
    }

    /**
     * Визначаємо права на дії контролера
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // права для відвідувачів
                'actions' => array('index', 'view', 'ajax', 'search'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('rating'),
                'users' => array('@'),
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
     * Відображення усіх книжок, сортування книжок за жанром, та пошук за назвою
     *
     * @return mixed|string
     */
    public function actionIndex()
    {
        $dependecy = new CDbCacheDependency('SELECT MAX(updated) FROM {{books}}');
        $books = new CActiveDataProvider(Books::model()->cache(60*60, $dependecy, 1), array (
            'pagination' => array (
                'pageSize' => 5,
            )
        ));
        if (Yii::app()->request->isAjaxRequest && (isset($_POST['name']) || isset($_POST['genre']))) {
            if (isset($_POST['name'])) {
                $criteria = new CDbCriteria();
                $criteria->compare('name', $_POST['name'], true);
                $criteria->order = 'id DESC';
            } else {
                $criteria = array(
                    'condition' => 'genre = :genre',
                    'params'    => array(':genre' => $_POST['genre']),
                    'order'     => 'id DESC'
                );
            }
            $books = new CActiveDataProvider('Books', array(
                'criteria'   => $criteria,
                'pagination' => array(
                    'pageSize' => 5,
                ),));

            return $this->renderPartial('content', array(
                'dataProvider' => $books
            ));
        }

        return $this->render('index', array(
            'dataProvider' => $books
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
        $model = $this->loadModel($id, Books::model());
        $comment = $this->newComment($model);
        $comments = Books::model()->getComments($id);

        return $this->render('view', array(
            'model' => $model,
            'comment' => $comment,
            'comments' => $comments,
        ));
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
        $model = $this->loadModel($id, Books::model());
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
        $this->loadModel($id, Books::model())->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
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
     * Обробка рейтингу для екземпляру книги
     */
    public function actionRating()
    {
        $model = Likes::model()->findByAttributes(array('user_id' => $_POST['voter'], 'book_id' => $_POST['model']));
        $model = $this->handleRatingInstance($model);
        $model->book_id = $_POST['model'];
        $model->save();

        echo CJSON::encode(array(
            'up' => count(Likes::model()->findAllByAttributes(array('book_id' => $_POST['model'], 'up' => 1))),
            'down' => count(Likes::model()->findAllByAttributes(array('book_id' => $_POST['model'], 'down' => 1))),
        ));
    }
}
