<?php
/* @var $this BooksController */
/* @var $data Books */
?>
<div id="content">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/books/<?php echo $data->image; ?>" width="100"
         height="100">
    <h2><?php echo CHtml::link($data->name, array('books/view', 'id' => $data->id)); ?></h2>
    <?php if (strlen($data->description) > 500) { ?>
        <p><?php echo mb_substr($data->description, 0, 200, 'utf8') . "..."; ?></p>
        <?php echo CHtml::link('Читати далі', array('view', 'id' => $data->id)); ?>
    <?php } else { ?>
        <p><?php echo $data->description; ?></p>
    <?php } ?>
</div>
