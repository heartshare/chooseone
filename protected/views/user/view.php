<div class="container">
    <?php if ($model->ban == 1) { ?>
        <h3>Користувач <?php echo $model->user->login; ?> забанений</h3>
    <?php } else { ?>
        <div class="col-md-9">
            <?php
            if (($model->user_id == Yii::app()->user->id) && $model->ban != 1) {
                echo CHtml::link('Редагувати профіль', array('user/edit'));
            }
            ?>
            <?php
            if ((Yii::app()->user->getRole() == 2) && ($model->user_id != Yii::app()->user->id)) {
                if ($model->ban == 0) {
                    echo CHtml::ajaxLink('Бан', array('user/ban', 'id' => $model->id,
                        ), array(
                            'type'     => 'GET',
                            'dataType' => 'html',
                            'success'  => 'js:function(data) {
                                window.location.reload(true);
                            }'
                        )
                    );
                }
                if ($model->ban == 1) {
                    echo CHtml::ajaxLink('Поновити', array('user/unban', 'id' => $model->id),
                        array(
                            'type'     => 'GET',
                            'dataType' => 'html',
                            'success'  => 'js:function(data){
                                window.location.reload(true);
                            }',
                        )
                    );
                }
            } ?>
            <div class="container">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <img
                                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/profile/<?php echo $model->photo; ?>"
                                    alt="profile_avatar" width="250" height="550" class="img-responsive img-rounded">
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h4><?php echo $model->user->login; ?></h4>
                                <small>
                                    <cite title="San Francisco, USA">San Francisco, USA
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </cite>
                                </small>
                                <p>
                                    <i class="glyphicon glyphicon-user"></i><?php echo $model->info; ?><br/>
                                    <i class="glyphicon glyphicon-gift"></i><?php echo $model->birth; ?><br/>
                                    <i class="glyphicon glyphicon-time"></i><?php echo $model->registered; ?> <br/>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div id="feeds">
                <h3>Досягнення</h3> <br/>
                <?php foreach ($model->user->feed as $feed) { ?>
                    <h3><?php echo $feed->description; ?></h3>
                    <img src='/images/feed/<?php echo $feed->picture; ?>' title='<?php $feed->title ?>'>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
