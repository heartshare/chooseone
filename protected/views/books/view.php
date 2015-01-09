<?php
/* @var $this BooksController */
/* @var $model Books */

if (Yii::app()->user->getRole() == 2) {
    echo CHtml::link('Редагувати', array('books/update', 'id' => $model->id), array('class' => 'btn btn-success'));
    echo CHtml::link('Видалити', array('books/delete', 'id' => $model->id), array('id' => 'delbutton', 'class' => 'btn btn-success'));
}
if (Yii::app()->user->hasFlash('commentSubmitted')) {
    ?>
    <div class="alert alert-success">
        <strong>
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </strong>
    </div>
<?php } ?>

<div>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/books/<?php echo $model->image; ?>" width="100"
         height="100">

    <h3><?php echo $model->name; ?></h3>

    <p><?php echo $model->description; ?></p>
    Завантажити:
    <a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/books/<?php echo $model->book; ?>"
       title="download it"><?php echo $model->book; ?></a>
</div>

<div>
    <?php

    echo CHtml::ajaxLink($model->getUpVotes(), array('rating'), array(
        'type' => 'POST',
        'data' => array(
            'voter' => Yii::app()->user->id,
            'model' => $model->id,
            'up' => true
        ),
        'dataType' => 'json',
        'success' => 'js: function (data) {

        }'
    ), array('class' => 'glyphicon glyphicon-hand-up'));

    echo CHtml::ajaxLink($model->getDownVotes(), array('rating'), array(
        'type' => 'POST',
        'data' => array(
            'voter' => Yii::app()->user->id,
            'model' => $model->id,
            'down' => true,
        ),
        'dataType' => 'json',
        'success' => 'js: function (data) {

        }'
    ), array('class' => 'glyphicon glyphicon-hand-down'));

    ?>
</div>

<br>
<?php
if (!Yii::app()->user->isGuest) {
    $this->renderPartial('/comments/_form', array(
        'model' => $comment,
    ));
} else {
    echo "<h2>Ви повинні бути авторизовані, щоб залишити коментар</h2>";
}

$this->renderPartial('/comments/_comments', array(
    'comments' => $comments,
));
