<?php
/* @var $this BooksController */
/* @var $model Books */

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'template' => "{items}\n{pager}",
    'ajaxUpdate' => 'true',
    'enablePagination' => true,
));
