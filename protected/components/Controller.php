<?php

/**
 * Контролер що розширює базовий клас контролера.
 * Всі контролери додатку повинні наслідуватись від цього контролера.
 */
class Controller extends CController
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
     * Обробляємо новий коментар для переданої в параметри моделі
     *
     * @param $model
     * @return Comments
     */
    public function newComment($model)
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
     * Пошук екземпляру в БД, за визначеним ID та класом моделі
     *
     * @param $id
     * @param $modelInstance , in example ModelClass::model()
     * @return mixed
     * @throws CHttpException
     */
    public function loadModel($id, $modelInstance)
    {
        $model = $modelInstance->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'Запису з вказаним ID не існує');
        }

        return $model;
    }
}
