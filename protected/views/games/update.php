<?php
/* @var $this GamesController */
/* @var $model Games */
?>

<h1>Редагувати гру <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model, 'screens' => $screens));
