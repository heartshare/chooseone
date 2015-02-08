<?php
/* @var $this GenresController */
/* @var $model Genres */
?>

<h1>Редагування жанру <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
