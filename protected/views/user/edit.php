<div class="col-lg-4">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'profile-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Поля з <span class="required">*</span> обовязкові.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'photo'); ?>
        <?php echo $form->fileField($model, 'photo', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'photo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('class' => 'form-control', 'size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'info'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Зберегти' : 'Створити', array('class' => 'btn btn-success')); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
