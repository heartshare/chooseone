<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;

$this->widget('ext.yii_tagger.ETagInputWidget',
    array(
        'model'     => Genres::model(),
        'attribute' => 'name',
        'multiple'  => true,
    ));
?>

<div class="container">
    <?php if (Yii::app()->user->hasFlash('registered')) { ?>
        <div class="alert alert-success">
            <strong>
                <?php echo Yii::app()->user->getFlash('registered'); ?>
            </strong>
        </div>
    <?php } ?>

    <h1>Hello, world!</h1>

    <p>
        This is a template for a simple marketing or informational website. It includes a large callout called a
        jumbotron and three supporting pieces of content. Use it as a starting point to create something more
        unique.
    </p>

    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>Heading</h2>

            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>

            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis
                euismod. Donec sed odio dui. </p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>

            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
                porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                fermentum massa justo sit amet risus.</p>

            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>


    <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/t2.jpg" width="1892"
                               height="776"></div>
        <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/t2.jpg" width="1892"
                               height="776"></div>
        <div class="item"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/slider/t2.jpg" width="1892"
                               height="776"></div>
    </div>

    <div id="last-comments">
        <?php
        $this->widget('MyLastComments', array(
            'limit' => 5,
        ));
        ?>
    </div>

</div>
