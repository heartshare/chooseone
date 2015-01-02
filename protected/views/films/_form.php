<?php
/* @var $this FilmsController */
/* @var $model Films */
/* @var $form CActiveForm */
?>

<div class="col-lg-4">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'films-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>

        <p class="note">Поля з <span class="required">*</span> обовязкові.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'genre'); ?>
            <?php echo $form->textField($model, 'genre', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'genre'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'vfile'); ?>
            <?php echo $form->fileField($model, 'vfile', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'vfile'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'image'); ?>
            <?php echo $form->fileField($model, 'image', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'image'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберети', array('class' => 'btn btn-success')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
