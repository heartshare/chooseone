<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<?php $this->renderPartial('/layouts/admin_block', array('model' => $model)); ?>

<br>

<?php $this->renderPartial('/layouts/comment_flash', array('model' => $model)); ?>

<br>

<div class="row">
    <div class="col-md-12">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/films/<?php echo $model->image; ?>" width="200"
             height="300">
        <h1><?php echo $model->name; ?></h1>
        <p><?php echo $model->description; ?></p>
    </div>
</div>

<br>

<div class="row">
    <?php $this->renderPartial('/layouts/rating_block', array('model' => $model)); ?>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <?php
            $this->widget('application.extensions.eflow.EFlowPlayer', array(
                'flv' => Yii::app()->request->baseUrl . "/uploads/videos/" . $model->vfile,
                'htmlOptions' => array(
                    'id' => 'testingplayer',
                    'style' => 'width: 620px; height: 360px;',
                ),
            ));
        ?>
    </div>
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
