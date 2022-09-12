<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WinLottery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="win-lottery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lotteryId')->dropDownList($listDataLottery, ['prompt' => Yii::t('app', 'Select Lottery')]) ?>

    <?= $form->field($model, 'typeLotteryId')->dropDownList($listDataTypeLottery, ['prompt' => Yii::t('app', 'Select Type Lottery')]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
