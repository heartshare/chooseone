<?php
/* @var $this UserController */
/* @var $model LoginForm */
/* @var $form CActiveForm */
?>

<div class="col-lg-4">
    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'id' => 'username', "data-required" => "true")); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'id' => 'password')); ?>
        </div>

        <div class="input-group">
            <div class="checkbox">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'rememberMe'); ?>
            </div>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Увійти', array('id' => 'btn-login', 'class' => 'btn btn-success')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>
