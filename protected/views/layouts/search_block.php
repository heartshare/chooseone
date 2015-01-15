<div class="container">
    <div id="navbar" class="navbar-collapse collapse">
        <form class="navbar-form navbar-left">
            <div>Фільтр за жанром:</div>
            <div class="dropdown">
                <?php
                echo CHtml::dropDownList('list', 'genre', CHtml::listData($model->findAll(), 'genre', 'genre'), array(
                    'class' => 'dropdown-menu',
                    'style' => 'display: inline-block',
                    'ajax' => array(
                        'type' => 'POST',
                        'url' => $this->createUrl($url),
                        'data' => array('genre' => 'js:this.value',),
                        'dataType' => 'html',
                        'success' => 'js: function(data){
                             $("#data").html(data);
                         }',
                    ),
                    'empty' => 'Виберіть жанр',
                ));
                ?>
            </div>


        </form>
        <form class="navbar-form navbar-right">
            <?php echo CHtml::textField('Пошук по розділу', '', array('id' => 'tf', 'class' => 'form-control')); ?>
            <?php
            echo CHtml::ajaxLink('Пошук', array($url), array(
                'type' => 'POST',
                'data' => array('name' => 'js: $("#tf").val()'),
                'dataType' => 'html',
                'success' => 'js: function(data){
            $("#data").html(data);
        }'
            ), array('class' => 'btn btn-success', 'style' => 'color:white'));?>
        </form>
    </div>
    <!--/.navbar-collapse -->
</div>
