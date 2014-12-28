<style type="text/css">
    #info {

        color: #ffffff;
        margin-left: -35px;
    }

    body {
        background-color: steelblue;
    }

    .form {
        color: #ffffff;
        font-size: 18px;
        margin-left: 550px;
        margin-top: 100px;

    }

    #green-button {
        color: #000000;
        margin-left: 20px;
        text-decoration: none;
        text-align: center;
        padding: 11px 32px;
        border: solid 1px #647075;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        font: 14px Arial, Helvetica, sans-serif;
        font-weight: bold;

        background-color: silver;
        background-image: -moz-linear-gradient(top, silver 0%, silver 100%);
        background-image: -webkit-linear-gradient(top, silver 0%, silver 100%);
        background-image: -o-linear-gradient(top, silver 0%, silver 100%);
        background-image: -ms-linear-gradient(top, silver 0%, silver 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#96a0a3', endColorstr='#96a0a3', GradientType=0);
        background-image: linear-gradient(top, #8d9a9e 0%, #96a0a3 100%);
        -webkit-box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        -moz-box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;

        text-shadow: 2px 0px 2px #bababa;
        filter: dropshadow(color=#bababa, offx=2, offy=0);
    }

    #green-button:hover {
        padding: 11px 32px;
        border: solid 1px #005072;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        font: 14px Arial, Helvetica, sans-serif;
        font-weight: bold;
        color: #000000;
        background-color: silver;
        background-image: -moz-linear-gradient(top, silver 0%, silver 100%);
        background-image: -webkit-linear-gradient(top, silver 0%, silver 100%);
        background-image: -o-linear-gradient(top, silver 0%, silver 100%);
        background-image: -ms-linear-gradient(top, silver 0%, silver 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1982a5', endColorstr='#1982a5', GradientType=0);
        background-image: linear-gradient(top, #3ba4c7 0%, #1982a5 100%);
        -webkit-box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        -moz-box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
        box-shadow: 0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;

        text-shadow: 2px 0px 2px #bababa;
        filter: dropshadow(color=#bababa, offx=2, offy=0);
    }

    #logins {
        border-radius: 5px;
        width: 170px;
        height: 30px;
        margin: 5px;
    }

</style>


<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'registr-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); ?>


    <div id="info">
        <?php
        Yii::app()->clientScript->registerScript(
            'myHideEffect',
            '$("#info").fadeTo("slow",0.5).fadeOut("slow");',
            CClientScript::POS_READY
        );
        if (Yii::app()->user->hasFlash('login')):?>


            <?php echo Yii::app()->user->getFlash('login'); ?>

        <?php endif ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'login'); ?>
        <?php echo $form->textField($model, 'login', array('id' => 'logins')); ?>
        <?php echo $form->error($model, 'login'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('id' => 'logins')); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="row">
        <?php  echo $form->labelEx($model,'email'); ?>
        <?php echo $form->passwordField($model, 'email', array('id' => 'logins')); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <?php echo CHtml::submitButton('Реєстрація', array('id' => 'green-button')); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->
