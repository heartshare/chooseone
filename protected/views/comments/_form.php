<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comments-form',
        'enableAjaxValidation' => false,
    )); ?>

    <h2>Додай власний коментар!</h2>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Редагувати', array('class' => 'btn btn-success')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>
