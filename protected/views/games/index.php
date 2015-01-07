<?php
/* @var $this GamesController */
/* @var $dataProvider CActiveDataProvider */

$this->renderPartial('/layouts/search_block', array(
    'url' => 'games/index',
    'model' => Games::model()
));
?>

<br>

<div id="data">
    <?php $this->renderPartial('content', array('dataProvider' => $dataProvider)); ?>
</div>
