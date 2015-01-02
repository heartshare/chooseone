<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */
$this->pageTitle = Yii::app()->name . ' - Contact Us';
?>

<h1>Звязатись з адміністрацією</h1>
<p>Якщо у вас є побажання, пропозиції чи запитання можете звязатись з адміністрацією.Дякуємо.</p>

<?php if (Yii::app()->user->hasFlash('contact')) { ?>
    <div class="alert alert-success">
        <strong>
        <span class="glyphicon glyphicon-send"></span>
        <?php echo Yii::app()->user->getFlash('contact'); ?>
        </strong>
    </div>
<?php } ?>

<div class="col-lg-6">

    <div class="well well-sm">
        <small><i class="glyphicon glyphicon-asterisk form-control-feedback"></i> Обовязкові поля</small>
    </div>

    <div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'contact-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        )); ?>
        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'Імя*'); ?>
            <div class="input-group">
                <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-asterisk form-control-feedback"></i>
                </span>
            </div>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'Email*'); ?>
            <div class="input-group">
                <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-asterisk form-control-feedback"></i>
                </span>
            </div>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'Тема*'); ?>
            <div class="input-group">
                <?php echo $form->textField($model, 'subject', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-asterisk form-control-feedback"></i>
                </span>
            </div>
            <?php echo $form->error($model, 'subject'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'Лист*'); ?>
            <div class="input-group">
                <?php echo $form->textArea($model, 'body', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-asterisk form-control-feedback"></i>
                </span>
            </div>
            <?php echo $form->error($model, 'body'); ?>
        </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="form-group">
                <?php echo $form->labelEx($model, 'Код*'); ?>
                <div class="input-group">
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Введіть літери для перевірки.</div>
                <?php echo $form->error($model, 'verifyCode'); ?>
            </div>
        <?php endif; ?>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Відправити', array('class' => 'btn btn-info pull-right')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->

</div>
