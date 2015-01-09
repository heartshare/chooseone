<?php
/* @var $this GamesController */
/* @var $data Games */
?>

<div class="container">
    <div class="well">
        <div class="media">
            <a class="pull-left" href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/<?php echo $data->image; ?>" width="100" height="100">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo CHtml::link($data->name, array('view', 'id' => $data->id)); ?></h4>

                <p>
                <?php if (strlen($data->description) > 150) {
                    echo mb_substr($data->description, 0, 250, 'utf8') . "...";
                } else {
                    echo $data->description;
                } ?>
                <br />
                <?php echo CHtml::link('Читати далі', array('view', 'id' => $data->id)); ?>
                </p>

                <ul class="list-inline list-unstyled">
                    <li><span><i class="glyphicon glyphicon-calendar"></i> <?php echo date('d.m.Y H:i:s', $data->created); ?> </span></li>
                    <li>|</li>
                    <span><i class="glyphicon glyphicon-comment"></i> <?php echo count($data->comments); ?> comments</span>
                    <li>|</li>
                    <!--<li>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                    </li>
                    <li>|</li>-->
                    <li>
                        <span><i class="fa fa-facebook-square"></i></span>
                        <span><i class="fa fa-twitter-square"></i></span>
                        <span><i class="fa fa-google-plus-square"></i></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
