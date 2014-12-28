<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<?php foreach ($model as $game): ?>
    <img src="/images/games/<?php echo $game->image; ?>" width="100" height="100" id="imgs">
    <div id="content">
        <h3 id="name"><?php echo CHtml::link($game->name, array('view', 'id' => $game->id)); ?></h3>
        <?php if (strlen($game->description) > 150) { ?>

            <p id="descript"><?php echo mb_substr($game->description, 0, 250, 'utf8') . "..."; ?></p>
            <?php echo CHtml::link('Читати далі', array('view', 'id' => $film['id'])); ?>

        <?php } ?>
    </div>

<?php endforeach; ?>
<?php
/*$this->widget('CLinkPager', array(
    'pages' => $pages,
    'prevPageLabel' => '&laquo; назад',
    'nextPageLabel' => 'далі &raquo;',
    'cssFile' => Yii::app()->theme->baseUrl . '/css/pager.css',
))*/?>
