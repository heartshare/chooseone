<?php
Yii::app()->clientScript->registerScript(
    'myHideEffect',
    '$("#info").delay(5000).fadeOut(500)',
    CClientScript::POS_READY
);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div id="info">
                <?php
                if (Yii::app()->user->hasFlash('login')) {
                    echo Yii::app()->user->getFlash('login');
                }
                ?>
            </div>
            <div class="form">
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'registr-form',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                )); ?>

                <?php echo $form->errorSummary($model); ?>

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'login'); ?>
                        <?php echo $form->textField($model, 'login', array('id' => 'login', 'class' => 'form-control')); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'password', array('id' => 'password', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model, 'email', array('id' => 'email', 'class' => 'form-control')); ?>
                        </div>
                    </div>
                </div>

                <?php echo CHtml::submitButton('Реєстрація', array('id' => 'register', 'class' => 'btn btn-success')); ?>

                <?php $this->endWidget(); ?>
            </div>
            <!-- form -->
        </div>
    </div>
</div>
