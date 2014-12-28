<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<?php foreach ($model as $book) { ?>

    <img src="/images/books/<?php echo $book->image; ?>" width="100" height="100" id="imgs">

    <div id="content">

        <h2><?php echo CHtml::link($book->name, array('books/view', 'id' => $book->id)); ?></h2>
        <?php if (strlen($book->description) > 500) { ?>
            <p><?php echo mb_substr($book->description, 0, 200, 'utf8') . "..."; ?></p>
            <?php echo CHtml::link('Читати далі', array('view', 'id' => $book->id)); ?>
        <?php } else { ?>
            <p><?php echo $book->description; ?></p>
        <?php } ?>

    </div>

<?php
}

$this->widget('CLinkPager', array(
    'pages' => $pages,
    'prevPageLabel' => '&laquo; назад',
    'nextPageLabel' => 'далі &raquo;',
    'cssFile' => Yii::app()->baseUrl . '/css/pager.css',
));
