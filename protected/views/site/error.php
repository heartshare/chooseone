<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
?>
<style type="text/css">
    .error-template {
        padding: 40px 15px;
        text-align: center;
    }

    .error-actions {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .error-actions .btn {
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1> Oops! The server returned a <?php echo $code; ?>.</h1>

                <div class="error-details">
                    <?php echo CHtml::encode($message); ?>!
                </div>

                <div class="error-actions">

                    <a href="<?php echo $this->createUrl('site/index'); ?>" class="btn btn-primary btn-lg">
                        <span class="glyphicon glyphicon-home"></span>Take Me Home
                    </a>

                    <a href="<?php echo $this->createUrl('site/contact'); ?>" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-envelope"></span> Contact Us
                    </a>

                </div>

            </div>
        </div>
    </div>
</div>

