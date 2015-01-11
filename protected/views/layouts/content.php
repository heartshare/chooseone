<?php
/* @var $this FilmsController */
/* @var $model Films */

$this->widget('zii.widgets.CListView', array(
    'dataProvider'     => $dataProvider,
    'itemView'         => '_view',
    'template'         => "{items}\n{pager}",
    'pager' => array(
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'maxButtonCount'=>'5',
        'htmlOptions' => array(
            'class' => 'pagination',
            'id' => ''
        ),
    ),
    'ajaxUpdate'       => 'true',
    'enablePagination' => true,
));
