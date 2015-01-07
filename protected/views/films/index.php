<?php
/* @var $this FilmsController */
/* @var $dataProvider CActiveDataProvider */

$this->renderPartial('/layouts/search_block', array(
    'url' => 'films/index',
    'model' => Films::model()
));
?>

<br>

<div id="data">
    <?php $this->renderPartial('content', array('dataProvider' => $dataProvider)); ?>
</div>
