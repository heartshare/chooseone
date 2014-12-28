<?php
/* @var $this SiteController */
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
        <div class="row">
            <?php echo $form->labelEx($model, 'Логін'); ?>
            <?php echo $form->textField($model, 'username', array('class' => 'form-control', 'id' => 'username', 'placeholder' => 'Логін')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'Пароль'); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => 'Пароль')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="input-group">
            <div class="checkbox">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
                <?php echo $form->label($model, 'Запамятати мене'); ?>
                <?php echo $form->error($model, 'rememberMe'); ?>
            </div>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Увійти', array('id' => 'btn-login', 'class' => 'btn btn-success')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
</div>
