<?php
/* @var $this ScreensController */
/* @var $model Screens */

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'screens-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'image',
        'game_id',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
