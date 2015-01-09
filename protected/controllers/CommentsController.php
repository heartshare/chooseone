<?php

class CommentsController extends Controller
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
        );
    }

    /**
     * Права доступу до дій контролера
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users'   => array('*'),
            ),
            array('allow', // правила для звичайних аутентифікованих користувачів
                'actions' => array('create', 'update', 'delete'),
                'users'   => array('@'),
                'roles'   => array(1),
            ),
            array('allow', // правила для адміністратора
                'actions' => array('admin', 'delete', 'create', 'update', 'delete'),
                'users'   => array('test'),
                'roles'   => array(2)
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Відображення конкретного коментаря
     *
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', array(
            'model' => $this->loadModel($id, Comments::model()),
        ));
    }

    /**
     * Редагування коментаря визначеного за ID
     *
     * @param $id
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, Comments::model());
        if (isset($_POST['Comments'])) {
            $model->attributes = $_POST['Comments'];
            $model->save();
        }

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Видалення коментаря визначеного за ID
     *
     * @param $id
     */
    public function actionDelete($id)
    {
        $this->loadModel($id, Comments::model())->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Сторінка керування коментарями для адміністратора
     *
     * @return string
     */
    public function actionAdmin()
    {
        $model = new Comments('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Comments'])) {
            $model->attributes = $_GET['Comments'];
        }

        return $this->render('admin', array(
            'model' => $model,
        ));
    }
}
