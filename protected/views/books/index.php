<?php
/* @var $this BooksController */
/* @var $dataProvider CActiveDataProvider */

$this->renderPartial('/layouts/search_block', array(
    'url' => 'books/index',
    'model' => Books::model()
));
?>

<br>

<div id="data">
    <?php $this->renderPartial('content', array('dataProvider' => $dataProvider)) ?>
</div>
