<?php
/* @var $this ScreensController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Screens</h1>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
