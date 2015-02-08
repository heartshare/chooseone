<?php
/* @var $this GenresController */
/* @var $model Genres */
/* @var $form CActiveForm */
?>

<div class="col-lg-4">
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'genres-form',
            'enableAjaxValidation' => true,
        )); ?>

        <p class="note">Поля з <span class="required">*</span> обовязкові.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <br />

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Додати', array('class' => 'btn btn-success')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
