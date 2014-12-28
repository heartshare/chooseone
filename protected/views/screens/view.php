<?php
/* @var $this ScreensController */
/* @var $model Screens */
?>

<h1>View Screens #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'image',
        'game_id',
    ),
)); ?>
