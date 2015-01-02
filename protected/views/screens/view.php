<?php
/* @var $this ScreensController */
/* @var $model Screens */

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'image',
        'game_id',
    ),
));
