<?php
/* @var $this FilmsController */
/* @var $model Films */
/* @var $form CActiveForm */
?>
<style>
    #h{
        float: left;

    }
#date{
margin-left: 650px;
}

</style>
<div class="wide form">

    <?php  foreach($comments as $comment):?>
        <div class="comments">
            <span> <h3 id="h"><?php echo CHtml::link($comment->author,array('site/view','id'=>$comment->author_id));?></h3> <span id="date">Додано: <?php echo date('G:i:s ,j.n.Y',$comment->date); ?></span></span>
            <p><?php echo $comment->content; ?></p>

            <?php if($comment->author == Yii::app()->user->getName() || Yii::app()->user->checkAccess(2)){?>
                <p><?php echo CHtml::link('Видалити',array('comments/delete','id'=>$comment->id));?></p>
            <?php }?>
        </div>
    <?php  endforeach ?>
</div>

