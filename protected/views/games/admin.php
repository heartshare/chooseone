<?php
/* @var $this GamesController */
/* @var $model Games */

echo CHtml::link('Додати гру', array('games/create'), array('class' => 'btn btn-success')); ?>

<h1>Ігри</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'           => 'games-grid',
    'dataProvider' => $model->search(),
    'filter'       => $model,
    'columns'      => array(
        'name',
        'description',
        'image',
        'genre',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
