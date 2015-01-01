<div class="content"
    <div class="col-md-4" id="comments_replace">
        <div class="detailBox">
            <div class="titleBox">
                <label>Останні коментарі</label>
            </div>
            <div class="actionBox">
                <ul class="commentList">
                    <?php foreach ($comments as $coment) { ?>
                        <li>
                            <div class="commenterImage">
                                <img
                                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/profile/<?php echo $coment->author->profile->photo; ?>"
                                    width="80" height="80" class="img-circle" id="profile_comments_avatar" alt=""/>
                            </div>
                            <div class="commentText">
                                <p><?php echo $coment->content; ?></p>

                                <p><?php echo $coment->date; ?></p>
                                By: <?php echo $coment->author->login; ?>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
