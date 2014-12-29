<style>
    h1 {
        text-align: center
    }
</style>
<?php
/* @var $this FilmsController */
/* @var $model Films */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#films-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>
<?php echo CHtml::link('Додати книгу', array('films/create')); ?>
<h1>Фільми</h1>
<?php echo CHtml::link('Пошук', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial('_search', array(
        'model' => $model,
    )); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'films-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'name',
        'description',
        'vfile',
        'image',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
)); ?>
