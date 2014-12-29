<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div id="info">
                <?php
                Yii::app()->clientScript->registerScript(
                    'myHideEffect',
                    '$("#info").fadeTo("slow",0.5).fadeOut("slow");',
                    CClientScript::POS_READY
                );
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

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'login'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model, 'login', array('class' => 'form-control')); ?>
                        </div>
                        <?php echo $form->error($model, 'login'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <div class="controls">
                            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                        </div>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>

                <div class="control-group">
                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <div class="controls">
                            <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                        </div>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>

                <?php echo CHtml::submitButton('Реєстрація', array('class' => 'btn btn-success')); ?>

                <?php $this->endWidget(); ?>
            </div>
            <!-- form -->
        </div>
    </div>
</div>
