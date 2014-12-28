<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'profile-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    )); ?>

    <p class="note">Поля з  <span class="required">*</span> обовязкові.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'photo'); ?>
        <?php echo $form->fileField($model,'photo'); ?>
        <?php echo $form->error($model,'photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'info'); ?>

        <?php echo $form->textArea($model,'info',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'info'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
