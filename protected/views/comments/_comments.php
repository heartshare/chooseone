<?php
/* @var $this FilmsController */
/* @var $model Films */
/* @var $form CActiveForm */
?>

<div class="panel panel-default widget">
    <div class="panel-heading">
        <span class="glyphicon glyphicon-comment"></span>
        <h3 class="panel-title">Коментарі</h3>
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <?php foreach ($comments as $comment) { ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-2 col-md-1">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/profile/<?php echo $comment->author->profile->photo; ?>"
                                width="80" height="80" class="img-circle" id="profile_comments_avatar" alt="">
                        </div>
                        <div class="col-xs-10 col-md-11">
                            <div id="commnet_noimage">
                                <div>
                                    <div class="mic-info">
                                        By:<?php echo CHtml::link($comment->author->login, array('user/view', 'id' => $comment->author_id)); ?>
                                        on <?php echo $comment->date; ?>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <?php echo $comment->content; ?>
                                </div>
                                <?php if ($comment->author == Yii::app()->user->getName() || Yii::app()->user->checkAccess(2)) { ?>
                                    <div class="action">
                                        <?php echo CHtml::link('
                                        <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                        </button>',
                                            array('comments/update', 'id' => $comment->id));?>
                                        <?php echo CHtml::link('
                                        <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>',
                                            array('comments/delete', 'id' => $comment->id));?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
