<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<?php foreach ($model as $film) { ?>

    <img src="/images/films/<?php echo $film->image ?>" width="100" height="100" id="imgs">

    <div id="content">

        <h3 id="name">
            <?php echo CHtml::link($film->name, array('view', 'id' => $film->id)); ?>
        </h3>

        <p id="descript">
            <?php
                if (strlen($film->description) > 200) {
                    echo mb_substr($film->description, 0, 200, 'utf8') . "...";
                    echo "<br />";echo "<br />";
                    echo CHtml::link('Читати далі', array('view', 'id' => $film->id));
                } else {
                    echo $film->description;
                }
            ?>
        </p>
    </div>

<?php }
 $this->widget('CLinkPager', array(
    'pages' => $pages,
    'prevPageLabel' => '&laquo; назад',
    'nextPageLabel' => 'далі &raquo;',
    'cssFile' => Yii::app()->baseUrl . '/css/pager.css',
));
