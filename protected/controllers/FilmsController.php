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
     * Відображення усіх фільмів, пошук за назвою та фільт за жанром
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Films', array(
            'pagination' => array(
                'pageSize' => 5,
            ),));
        if (Yii::app()->request->isAjaxRequest && (isset($_POST['name']) || isset($_POST['genre']))) {
            if (isset($_POST['name'])) {
                $criteria = array(
                    'condition' => 'name = :name',
                    'params'    => array(':name' => $_POST['name']),
                    'order'     => 'id DESC'
                );
            } else {
                $criteria = array(
                    'condition' => 'genre=:genre',
                    'params'    => array(':genre' => $_POST['genre']),
                    'order'     => 'id DESC'
                );
            }
            $dataProvider = new CActiveDataProvider('Films', array(
                'criteria'   => $criteria,
                'pagination' => array(
                    'pageSize' => 5,
                ),));

            return $this->renderPartial('content', array(
                'dataProvider' => $dataProvider
            ));
        }

        return $this->render('index', array(
            'dataProvider' => $dataProvider
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
