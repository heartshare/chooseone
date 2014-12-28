<?php
/* @var $this CommentsController */
/* @var $model Comments */
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'author',
		'content',
		'film_id',
		'book_id',
		'game_id',
	),
)); ?>
