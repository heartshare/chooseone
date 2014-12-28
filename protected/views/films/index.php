<?php
/* @var $this FilmsController */
/* @var $dataProvider CActiveDataProvider */
?>

<div>
    <?php
        echo CHtml::dropDownList('list', 'genre', CHtml::listData(Films::model()->findAll(), 'genre', 'genre'), array(
            'ajax' => array(
                'type' => 'GET',
                'url' => $this->createUrl('films/ajax'),
                'data' => array('genre' => 'js:this.value',),
                'dataType' => 'html',
                'success' => 'js: function(data){
                  $("#data").html(data);
                }',
            ), 'empty' => 'Виберіть жанр',
        ));
    ?>
    <span id="my-search">
<?php echo "Пошук по розділу" ?>
<?php echo CHtml::textField('Введіть текст', '', array('id' => 'tf')); ?>
<?php
echo CHtml::ajaxLink('Пошук', array('films/search'), array(
    'type' => 'GET',
    'data' => array('name' => 'js: $("#tf").val()'),
    'dataType' => 'html',
    'success' => 'js: function(data){
      $("#data").html(data);
    }'

), array('class' => 'button', 'style' => 'color:white'));
?></span></div>
<br>
<div id="data">
    <?php $this->renderPartial('content', array('model' => $model, 'pages' => $pages, 'count' => $count)); ?>
</div>