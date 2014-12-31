<?php if ($model->ban == 0) { ?>
    <h3>Користувач <?php echo $model->user->login; ?> забанений</h3>
<?php } ?>
<?php
if ($model->user_id == Yii::app()->user->id) {
    echo CHtml::link('Редагувати профіль', array('site/edit'));
} ?>
<?php if (Yii::app()->user->getRole() == 2) {
    echo CHtml::ajaxLink('Бан', array('user/ban', 'id' => $model->id,
        ), array(
            'type' => 'GET',
            'dataType' => 'html',
            'success' => 'js:function(data) {
                     window.location.reload(true);
                }'
        )
    );
    echo CHtml::ajaxLink('Поновити', array('user/unban', 'id' => $model->id),
        array(
            'type' => 'GET',
            'dataType' => 'html',
            'success' => 'js:function(data){
                window.location.reload(true);
            } ',
        )
    );
}
?>


<?php if (Yii::app()->user->getRole() == 2) {

}
?>

<div class="col-md-9">
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

<div id="feeds">
    <h3>Досягнення</h3> <br/>
    <?php foreach ($model->user->feed as $feed) { ?>
        <h3><?php echo $feed->description; ?></h3>
        <img src='/images/feed/<?php echo $feed->picture; ?>' title='<?php $feed->title ?>'>
    <?php } ?>
</div>
