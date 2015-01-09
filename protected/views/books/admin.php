<?php
/* @var $this BooksController */
/* @var $model Books */

echo CHtml::link('Додати книгу', array('books/create'), array('class' => 'btn btn-success')); ?>

<h1>Книги</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'books-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'description',
        'book',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
