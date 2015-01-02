<?php

/**
 * Контролер що відповідає за логіку роботи з книжками, в тому числі і з моделлю для книг
 */
class BooksController extends Controller
{

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
                'users'   => array('*'),
            ),
            array('allow', // права для адміністратора
                'actions' => array('admin', 'delete', 'create', 'update'),
                'roles'   => array(2),
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
        $model = $this->loadModel($id, Books::model());
        $comment = $this->newComment($model);

        return $this->render('view', array(
            'model'   => $model,
            'comment' => $comment,
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
}
