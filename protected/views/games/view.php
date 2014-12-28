<style type="text/css">
    #c
    {
        height:300px;
        padding: 20px;

    }

</style>
<?php
/* @var $this GamesController */
/* @var $model Games */
?>
<?php if(Yii::app()->user->getRole()==2){
    echo CHtml::link('Редагувати',array('games/update','id'=>$model->id,array('id'=>'edit')));
    echo CHtml::link('Видалити',array('games/delete','id'=>$model->id),array('id'=>'delbutton'));
}?>
<?php
if(Yii::app()->user->hasFlash('commentSubmitted'))
{
    echo  "<div class='flash-success'>";
    echo Yii::app()->user->getFlash('commentSubmitted');
    echo "</div>";
}
?>
    <div id="c">
        <img src="/images/games/<?php echo $model->image;?>" width="100" height="100" id="imgo">
        <h3><?php echo $model->name;?></h3>
        <p><?php echo $model->description;?></p>

<?php
foreach($model->screens as $screens):?>
    <a href="/images/games/screens/<?php  echo $screens->image;?>"  data-lightbox="screens"><img src="/images/games/screens/<?php  echo $screens->image;?>" width="180" height="180"></a>
<?php endforeach;?>

</div>
    <br />
<?php
if(!Yii::app()->user->isGuest)
{
    $this->renderPartial('/comments/_form',array(
        'model'=>$comment,
    ));
}
else
{
    echo "<h2>Ви повинні бути авторизовані, щоб залишити коментар</h2>";
}
?>
<?php $this->renderPartial('/films/_comments',array(
    'comments'=>$comments,

));

?>