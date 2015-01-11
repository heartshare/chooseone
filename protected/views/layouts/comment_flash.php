<?php if (Yii::app()->user->hasFlash('commentSubmitted')) { ?>
    <div class="row">
        <div class="alert alert-success">
            <strong>
                <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
            </strong>
        </div>
    </div>
<?php }
