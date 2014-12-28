<?php
/* @var $this GamesController */
/* @var $model Games */
?>

    <h1>Update Games <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>