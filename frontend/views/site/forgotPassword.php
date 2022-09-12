<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

//Yii::$app->clientScript->registerCoreScript('jquery')
?>
<div class="tab-group">


    <div id="forgot">
        <h1>Forgot Password!</h1>

        <?php
        $form = ActiveForm::begin(['id' => 'forgot-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])
            ->input('username', ['placeholder' => Yii::t('app','UserName')])->label(false)
        ?>

        <?= $form->field($model, 'birthDate')->widget(DatePicker::classname(), [
            'language' => 'th',
            'options' => ['placeholder' => Yii::t('app', 'Select birth date')],
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])->label(false); ?>

        <?= $form->field($model, 'password')->passwordInput()
            ->input('password', ['placeholder' => Yii::t('app','New Password')])->label(false)
        ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-primary', 'name' => 'forgot-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div><!-- tab-content -->

