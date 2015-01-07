<?php
/* @var $this GamesController */
/* @var $model Games */

if (Yii::app()->user->getRole() == 2) {
    echo CHtml::link('Редагувати', array('games/update', 'id' => $model->id), array('class' => 'btn btn-success'));
    echo CHtml::link('Видалити', array('games/delete', 'id' => $model->id), array('class' => 'btn btn-success'));
}

if (Yii::app()->user->hasFlash('commentSubmitted')) {
    ?>
    <div class="alert alert-success">
        <strong>
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </strong>
    </div>
<?php } ?>

    <div>
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/<?php echo $model->image; ?>" width="100"
             height="100">

        <h3><?php echo $model->name; ?></h3>

        <p><?php echo $model->description; ?></p>

        <p><?php echo $model->genre; ?></p>

        <?php foreach ($model->screens as $screens) { ?>
            <a href="<?php echo Yii::app()->request->baseUrl; ?>/images/games/screens/<?php echo $screens->image; ?>"
               data-lightbox="screens">
                <img
                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/games/screens/<?php echo $screens->image; ?>"
                    width="180" height="180">
            </a>
        <?php } ?>
    </div>

    <div>
        <?php

        echo CHtml::ajaxLink($model->getUpVotes(), array('rating'), array(
            'type'     => 'POST',
            'data'     => array(
                'voter' => Yii::app()->user->id,
                'model' => $model->id,
                'up'    => true
            ),
            'dataType' => 'html',
            'success'  => 'js: function(data) {
                  console.log(data);
//                $(this).html(data.up);
//                $("#dwn_vote").html(data.down);
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
            'success'  => 'js: function(data){
                console.log(data);
            }'
        ), array('class' => 'glyphicon glyphicon-hand-down', 'id' => 'dwn_vote'));

        ?>

    </div>

    <br/>
<?php
if (!Yii::app()->user->isGuest) {
    $this->renderPartial('/comments/_form', array(
        'model' => $comment,
    ));
} else {
    echo "<h2>Ви повинні бути авторизовані, щоб залишити коментар</h2>";
}

$this->renderPartial('/comments/_comments', array(
    'comments' => $comments,
));
