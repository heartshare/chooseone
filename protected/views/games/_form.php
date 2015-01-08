<?php
/* @var $this GamesController */
/* @var $model Games */
/* @var $form CActiveForm */
?>
<div class="col-lg-4">
    <div class="form">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'games-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('enctype' => 'multipart/form-data')
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model, 'genre'); ?>
            <?php echo $form->textField($model, 'genre', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'genre'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'image'); ?>
            <?php echo $form->fileField($model, 'image', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'image'); ?>
        </div>

        <b>Скріншоти</b>
        <?php
        $this->widget('CMultiFileUpload', array(
            'model' => $screens,
            'name' => 'screens',
            'attribute' => 'image',
            'accept' => 'jpg|png',
        ));
        ?>
        <div class="row buttons">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Створити' : 'Зберегти', array('class' => 'btn btn-success')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
