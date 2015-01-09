<div>
    <?php
    echo CHtml::ajaxLink($model->getUpVotes(), array('rating'), array(
        'type'     => 'POST',
        'data'     => array(
            'voter' => Yii::app()->user->id,
            'model' => $model->id,
            'up'    => true
        ),
        'dataType' => 'json',
        'success'  => 'js: function(data) {
                $("#up_vote").html(data.up);
                $("#dwn_vote").html(data.down);
        }'
    ), array('class' => 'glyphicon glyphicon-hand-up', 'id' => 'up_vote'));

    echo CHtml::ajaxLink($model->getDownVotes(), array('rating'), array(
        'type'     => 'POST',
        'data'     => array(
            'voter' => Yii::app()->user->id,
            'model' => $model->id,
            'down'  => true,
        ),
        'dataType' => 'json',
        'success'  => 'js: function(data) {
             $("#up_vote").html(data.up);
             $("#dwn_vote").html(data.down);
        }'
    ), array('class' => 'glyphicon glyphicon-hand-down', 'id' => 'dwn_vote')); ?>
</div>
