<?php
/* @var $this BooksController */
/* @var $model Books */
if (Yii::app()->user->getRole() == 2) {
    echo CHtml::link('Редагувати', array('books/update', 'id' => $model->id, array('id' => 'edit')));
    echo CHtml::link('Видалити', array('books/delete', 'id' => $model->id), array('id' => 'delbutton'));
}
if (Yii::app()->user->hasFlash('commentSubmitted')) {
    echo "<div class='flash-success'>";
    echo Yii::app()->user->getFlash('commentSubmitted');
    echo "</div>";
}
?>
<style type="text/css">
    #c {
        height: 300px;
        padding: 20px;
    }
</style>
<div id="c">
    <img src="/images/books/<?php echo $model->image; ?>" width="100" height="100" id="imgo">

    <h3><?php echo $model->name; ?></h3>

    <p><?php echo $model->description; ?></p>
    Завантажити:<a href="/uploads/books/<?php echo $model->book; ?>" title="download it"><?php echo $model->book; ?></a>
</div>
<br>
<?php
if (!Yii::app()->user->isGuest) {
    $this->renderPartial('/comments/_form', array(
        'model' => $comment,
    ));
} else {
    echo "<h2>Ви повинні бути авторизовані, щоб залишити коментар</h2>";
}
$this->renderPartial('/films/_comments', array(
    'comments' => $model->comments,
));
?>
