<?php
/* @var $this GenresController */
/* @var $model Genres */

echo CHtml::link('Додати жанр', array('genres/create'), array('class' => 'btn btn-success'));
?>

<h1>Керування жанрами</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'           => 'genres-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        'name',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
