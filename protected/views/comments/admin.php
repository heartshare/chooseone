<?php
/* @var $this CommentsController */
/* @var $model Comments */
?>

<h1>Керування коментарями в системі</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'           => 'comments-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        'content',
        'film_id',
        'book_id',
        'game_id',
        'author_id',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
