<?php
/* @var $this BooksController */
/* @var $model Books */
?>

<h1>Редагування книги <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
