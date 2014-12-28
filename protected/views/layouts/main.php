<?php /* @var $this Controller */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"/>

    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-1.11.1.min.js"></script>

    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.gdocsviewer.min.js"></script>
    <script type="text/javascript"
            src="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox/js/lightbox.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/layout.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php echo CHtml::link('ChooseOne', $this->createUrl('site/index'), array('class' => 'navbar-brand')); ?>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <?php echo CHtml::link('Books', $this->createUrl('books/index')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Films', $this->createUrl('films/index')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Games', $this->createUrl('games/index')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Contact Us', $this->createUrl('site/contact')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Login', $this->createUrl('site/login')); ?>
                </li>
                <li>
                    <?php echo CHtml::link('Sign in', $this->createUrl('site/registration')); ?>
                </li>
            </ul>




            <div id="jq">
                <div class="demo">
                    <span class="drop-down"> <span class="arrow">&#9660;</span></span>

                    <div class="drop-menu-main-sub">
                        <span class="title"></span>
                        <?php /* */ ?>
                        <?php /*if (Yii::app()->user->getRole() == 2) echo CHtml::link('Керування', array('site/admin')) */ ?>
                        <?php /*echo CHtml::link('Вийти', array('site/logout')) */ ?>
                    </div>
                </div>

            </div>
            <br>

            <?php if (!Yii::app()->user->isGuest) {  ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><?php echo CHtml::link('Профіль', array('site/view', 'id' => Yii::app()->user->getId())); ?></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>

        </div>
    </div>
</nav> <!--  Main menu navbar  -->

<div id="container">
    <?php echo $content; ?>
</div>


<!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="container">
        <h1>Hello, world!</h1>

        <p>This is a template for a simple marketing or informational website. It includes a large callout called a
            jumbotron and three supporting pieces of content. Use it as a starting point to create something more
            unique.</p>

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

    <hr>

    <footer>
        <p>&copy; Company 2014</p>
    </footer>
</div>
<!-- /container -->

</body>
</html>



<body>
