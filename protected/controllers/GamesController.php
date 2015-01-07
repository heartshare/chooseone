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
                'actions' => array('rating'),
                'users'   => array('@'),
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
     * Відображення усіх ігор, пошук за назвою та фільтр за жанром
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Games', array(
            'criteria' => array(
                'order' => 'id DESC'
            ),
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
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
            $dataProvider = new CActiveDataProvider('Games', array(
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

    public function actionRating()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $model = Likes::model()->findByAttributes(array('user_id' => $_POST['voter'], 'game_id' => $_POST['model']));
            if (null != $model) {
                if (isset($_POST['up']) && $model->up != 1) {
                    $model->up = 1;
                    $model->down = 0;
                } else if (isset($_POST['down']) && $model->down != 1) {
                    $model->up = 0;
                    $model->down = 1;
                } else {
                    $model->up = 0;
                    $model->down = 0;
                }
            } else {
                $model = new Likes();
                if ($_POST['up']) {
                    $model->up = 1;
                    $model->down = 0;
                } else {
                    $model->up = 0;
                    $model->down = 1;
                }
            }
            $model->user_id = $_POST['voter'];
            $model->game_id = $_POST['model'];
            $model->save();

            /*return CJSON::encode(array(
                'up' => count(Likes::model()->findAllByAttributes(array('game_id' => $_POST['model'], 'up' => 1))),
                'down' => count(Likes::model()->findAllByAttributes(array('game_id' => $_POST['model'], 'down' => 1))),
                )
            );*/
            return count(Likes::model()->findAllByAttributes(array('game_id' => $_POST['model'], 'up' => 1)));

        }
    }
}
