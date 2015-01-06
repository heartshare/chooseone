<?php
/* @var $this GamesController */
/* @var $data Games */
?>

<div class="content">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/<?php echo $data->image; ?>" width="100" height="100">
    <div id="content">
        <h3 id="name"><?php echo CHtml::link($data->name, array('view', 'id' => $data->id)); ?></h3>
        <?php if (strlen($data->description) > 150) { ?>

            <p id="descript"><?php echo mb_substr($data->description, 0, 250, 'utf8') . "..."; ?></p>
            <?php echo CHtml::link('Читати далі', array('view', 'id' => $data->id)); ?>

        <?php } ?>
    </div>
</div>
