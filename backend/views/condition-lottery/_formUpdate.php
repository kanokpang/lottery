<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ConditionLottery */
/* @var $form yii\widgets\ActiveForm */
?>
<h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'lotteryId')->dropDownList($listData, ['prompt' => Yii::t('app', 'Select Lottery')]) ?>

<?= $form->field($model, 'typeLotteryId')->dropDownList($listDataTypeLottery, ['prompt' => Yii::t('app', 'Select Type Lottery')]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'condition')->textInput() ?>

<?= $form->field($model, 'limit')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'isPurchaseLimit')->radioList([
    '0' => Yii::t('app', 'Not for sale'),
    '1' => Yii::t('app', 'Purchase Limit')
]); ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

