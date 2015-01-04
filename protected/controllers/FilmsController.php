<?php

class FilmsController extends Controller
{

    /**
     * Визначаємо права на дії контролера
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
                'users'   => array(Yii::app()->user->getName()),
                'roles'   => array(2),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Відображення усіх фільмів
     *
     * @return string
     */
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
     * Відображаємо конкретний фільм по ID
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id, Films::model());
        $comment = $this->newComment($model);

        return $this->render('view', array(
            'model'    => $model,
            'comment'  => $comment,
            'comments' => $model->getComments($id),

        ));
    }

    /**
     * Створення нового фільму
     *
     * @return string
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

        return $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Редагування уже існуючого фільму по ID
     *
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, Films::model());
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

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Видаляємо фільм по ID
     *
     * @param integer $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id, Films::model())->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Аяксовий пошук відповідних фільмів за жанром
     *
     * @return string
     */
    public function actionAjax()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'id DESC';
        $criteria->condition = 'genre = :genre';
        $criteria->params = array(':genre' => $_GET['genre']);
        $count = Books::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = Films::model()->findAll($criteria);

        return $this->renderPartial('content', array(
            'model' => $model,
            'pages' => $pages
        ));
    }

    /**
     * Пошук фільмів за назвою
     *
     * @return mixed|null|string
     */
    public function actionSearch()
    {
        $response = null;
        if (isset($_GET['name'])) {
            $model = Films::model()->findAllByAttributes(array('name' => $_GET['name']));
            if ($model) {
                $response = $this->renderPartial('content', array('model' => $model));
            } else {
                $response = 'За вашим запитом нічого не знайдено';
            }
        }

        return $response;
    }

    /**
     * Сторінка керування фільмами для адміністратора
     *
     * @return mixed|string
     */
    public function actionAdmin()
    {
        $model = new Films('search');
        $model->unsetAttributes();
        if (isset($_GET['Films'])) {
            $model->attributes = $_GET['Films'];
        }

        return $this->render('admin', array(
            'model' => $model,
        ));
    }
}
