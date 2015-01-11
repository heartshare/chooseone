<?php
/* @var $this BooksController */
/* @var $model Books */
?>

<?php $this->renderPartial('/layouts/admin_block', array('model' => $model)); ?>

<br>

<?php $this->renderPartial('/layouts/comment_flash', array('model' => $model)); ?>

<br>

<div class="row">
    <div class="col-md-12">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/books/<?php echo $model->image; ?>" width="100"
             height="100">

        <h3><?php echo $model->name; ?></h3>

        <p><?php echo $model->description; ?></p>
        Завантажити:
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/uploads/books/<?php echo $model->book; ?>"
           title="download it"><?php echo $model->book; ?></a>
    </div>
</div>

<br>

<div class="row">
    <?php $this->renderPartial('/layouts/rating_block', array('model' => $model)); ?>
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
