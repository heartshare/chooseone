<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<h1>Редагування <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>