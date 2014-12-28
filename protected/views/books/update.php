<?php
/* @var $this BooksController */
/* @var $model Books */
?>

<h1>Update Books <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>