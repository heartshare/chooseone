<?php
/* @var $this FilmsController */
/* @var $data Films */
?>

<div id="content">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/films/<?php echo $data->image ?>" width="100" height="100">
    <h3 id="name">
        <?php echo CHtml::link($data->name, array('view', 'id' => $data->id)); ?>
    </h3>
    <p>
        <?php
        if (strlen($data->description) > 200) {
            echo mb_substr($data->description, 0, 200, 'utf8') . "...";
            echo "<br />";echo "<br />";
            echo CHtml::link('Читати далі', array('view', 'id' => $data->id));
        } else {
            echo $data->description;
        }
        ?>
    </p>
</div>
