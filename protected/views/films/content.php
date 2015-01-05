<?php
/* @var $this FilmsController */
/* @var $model Films */

$this->widget('zii.widgets.CListView', array(
    'dataProvider'     => $dataProvider,
    'itemView'         => '_view',
    'template'         => "{items}\n{pager}",
    'ajaxUpdate'       => 'true',
    'enablePagination' => true,
));
