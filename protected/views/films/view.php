<style>

    #video_tab{

        margin-left: 150px;


    }
    #c
    {
        height:300px;
        padding: 20px;
    }


</style>
<?php
/* @var $this FilmsController */
/* @var $model Films */
?>

<?php if(Yii::app()->user->getRole()==2){
echo CHtml::link('Редагувати',array('films/update','id'=>$model->id,array('id'=>'edit')));
echo CHtml::link('Видалити',array('films/delete','id'=>$model->id),array('id'=>'delbutton'));
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
    <img src="/images/films/<?php echo $model->image;?>" width="200" height="300" id="imgo">
    <h1><?php echo $model->name;?></h1>
    <p><?php echo $model->description;?></p>
</div>

<div id="video_tab">
<?php
$this->widget('application.extensions.eflow.EFlowPlayer', array(
    'flv'=>"/uploads/videos/".$model->vfile,
    'htmlOptions'=>array(
        'id'=>'testingplayer',
        'style'=>'width: 620px; height: 360px;',
    ),
));?></div>
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
    <?php $this->renderPartial('_comments',array(
         'comments'=>$comments,

    ));

?>

