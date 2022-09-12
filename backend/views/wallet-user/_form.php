<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WalletUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallet-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userId')->widget(Select2::classname(), [
        'data' => $listData,
        'options' => ['placeholder' => Yii::t('app','Select a Full Name')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
