<?php
/* @var $this GamesController */
/* @var $model Games */
?>

<?php $this->renderPartial('/layouts/admin_block', array('model' => $model)); ?>

<br>

<?php $this->renderPartial('/layouts/comment_flash', array('model' => $model)); ?>

<br>

<div class="row">
    <div class="col-md-12">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/<?php echo $model->image; ?>" width="100"
             height="100">

        <h3><?php echo $model->name; ?></h3>

        <p><?php echo $model->description; ?></p>

        <p><?php echo $model->genre; ?></p>

        <?php foreach ($model->screens as $screens) { ?>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/images/games/screens/<?php echo $screens->image; ?>"
               data-lightbox="screens">
                <img
                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/screens/<?php echo $screens->image; ?>"
                    width="180" height="180">
            </a>
        <?php } ?>
    </div>
</div>

<br>

<div class="row">
    <?php $this->renderPartial('/layouts/rating_block', array('model' => $model)); ?>
</div>

<br/>

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
