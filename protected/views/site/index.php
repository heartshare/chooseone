<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
?>

<!--<div class="sld">
    <div id="slides">
        <img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/slider/peo1.jpg">
        <img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/slider/melo1.jpg">
        <img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/slider/212.jpg">
        <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
        <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
    </div>
</div>-->

<div id="last-comments">
    <?php
        $this->widget('MyLastComments', array(
            'limit' => 2,
        ));
    ?>
</div>