<div>
    <?php
    echo CHtml::dropDownList('list', 'genre', CHtml::listData($model->findAll(), 'genre', 'genre'), array(
        'ajax' => array(
            'type'     => 'POST',
            'url'      => $this->createUrl($url),
            'data'     => array('genre' => 'js:this.value',),
            'dataType' => 'html',
            'success'  => 'js: function(data){
                $("#data").html(data);
            }',
        ),
        'empty'     => 'Виберіть жанр',
    ));
    ?>
<span id="my-search">
    <?php
    echo CHtml::textField('Пошук по розділу', '', array('id' => 'tf'));
    echo CHtml::ajaxLink('Пошук', array($url), array(
        'type'     => 'POST',
        'data'     => array('name' => 'js: $("#tf").val()'),
        'dataType' => 'html',
        'success'  => 'js: function(data){
            $("#data").html(data);
        }'
    ), array('class' => 'button', 'style' => 'color:white'));?>
</span>
</div>
