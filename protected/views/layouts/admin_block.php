<?php if (Yii::app()->user->getRole() == 2) { ?>
    <div class="row">
        <div class="col-md-2">
            <?php
            echo CHtml::link('Редагувати', array('books/update', 'id' => $model->id), array('class' => 'btn btn-success'));
            ?>
        </div>
        <div class="col-md-2">
            <?php
            echo CHtml::link('Видалити', array('books/delete', 'id' => $model->id), array('id' => 'delbutton', 'class' => 'btn btn-success'));
            ?>
        </div>
    </div>
<?php }
