<?php

/**
 * Контролер що розширює базовий клас контролера.
 * Всі контролери додатку повинні наслідуватись від цього контролера.
 */
class Controller extends CController
{

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

    /**
     * Обробляємо екземпляр рейтингу та дані із масиву $_POST,
     * на основі чого ставимо значення полів для рейтингу
     *
     * @param Likes $model
     * @return Likes
     */
    public function handleRatingInstance(Likes $model)
    {
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
            if (isset($_POST['up'])) {
                $model->up = 1;
                $model->down = 0;
            } else {
                $model->up = 0;
                $model->down = 1;
            }
        }
        $model->user_id = $_POST['voter'];

        return $model;
    }
}
