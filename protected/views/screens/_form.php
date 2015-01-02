<?php
/* @var $this ScreensController */
/* @var $model Screens */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'screens-form',
        'enableAjaxValidation' => false,
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обовязкові.</p>

    <?php
    echo $form->errorSummary($model);

    $this->widget('CMultiFileUpload', array(
        'model' => $model,
        'name' => 'screens',
        'attribute' => 'image',
        'accept' => 'jpg|png',

    ));
    ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
