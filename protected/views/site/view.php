<style>
    #avatar{
        float: left;
    }
    #feeds{
        float: right;
        margin-top: -150px;
    }
    </style>
<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 12.04.14
 * Time: 8:56
 */
?>
<div id="user">
<?php
if($model->ban==0){
    if($model->user_id == Yii::app()->user->id){
        echo CHtml::link('Редагувати профіль',array('site/edit'));
        }
    ?>
<?php if(Yii::app()->user->getRole()==2){
    echo CHtml::ajaxLink('Бан',array('site/ban','id'=>$model->id,
         ),array(
        'type'=>'GET',
        'dataType'=>'html',
        'success'=>'js:function(data){
              window.location.reload(true);

        } '));
}?>
<img src="/images/profile/<?php echo $model->photo; ?>"  width='300px'  height='300px' id="avatar">
<h2><?php echo $model->user->login;?></h2>
<p><?php echo $model->info;?></p>
<p><?php echo "Зареєстровано:".$model->reg;?></p>
    <div id="feeds">
<?php
echo "<h3>Досягнення</h3>";
echo "<br>";
foreach($model->user->feed as $feed){
            echo "<h3>".$feed->description."</h3>";
            echo "<img src='/images/feed/$feed->picture' title='$feed->title'>";
}

}
else{
    echo "<span>Користувач <h3>".$model->user->login."</h3> забанений.</span>" ;
if(Yii::app()->user->getRole()==2){
    echo CHtml::ajaxLink('Поновити',array('site/unban','id'=>$model->id),
    array(
        'type'=>'GET',
        'dataType'=>'html',
        'success'=>'js:function(data){
           window.location.reload(true);
        } ',
    )
    );
}
}?>
        </div>
</div>