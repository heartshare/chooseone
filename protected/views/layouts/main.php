<?php /* @var $this Controller */ ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <!--  Stylesheets of application  -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Karla%7CMontserrat">
    <!--  Javascripts of application  -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery/jquery.gdocsviewer.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lightbox/js/lightbox.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/confirm.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/login_validation.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/register_validation.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/owl-carousel/owl.carousel.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="page">

    <div class="container">

        <div class="row">

            <!-- Main menu navbar -->
            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <?php echo CHtml::link('ChooseOne', $this->createUrl('site/index'), array('class' => 'navbar-brand')); ?>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li>
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
                        <?php if (Yii::app()->user->isGuest) { ?>
                            <li>
                                <?php echo CHtml::link('Login', $this->createUrl('user/login')); ?>
                            </li>
                            <li>
                                <?php echo CHtml::link('Sign in', $this->createUrl('user/registration')); ?>
                            </li>
                        <?php } ?>
                    </ul>

                    <?php if (!Yii::app()->user->isGuest) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name; ?>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?php echo CHtml::link('Профіль', array('user/view', 'id' => Yii::app()->user->getId())); ?></li>
                                    <li><?php echo CHtml::link('Вийти', array('user/logout')); ?></li>
                                    <li class="divider"></li>
                                    <li><?php if (Yii::app()->user->getRole() == 2) echo CHtml::link('Керування', array('user/dashboard')); ?></li>
                                </ul>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </nav>

        </div>

        <div class="row">
            <?php echo $content; ?>
        </div>

        <hr>

        <footer>
            <p>&copy; Company 2014</p>
        </footer>

    </div>
</div>
<!-- end of the page -->

</body>
</html>
