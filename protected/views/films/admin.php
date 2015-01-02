<?php
/* @var $this FilmsController */
/* @var $model Films */

echo CHtml::link('Додати книгу', array('films/create'), array('class' => 'btn btn-success')); ?>

<h1>Фільми</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'films-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'description',
        'vfile',
        'image',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
