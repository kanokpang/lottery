<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PaymentLottery */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'lotteryId')->dropDownList($listDataLottery, ['prompt' => Yii::t('app', 'Select Lottery')]) ?>

<?= $form->field($model, 'promotionLotteryId')->dropDownList($listDataPromotionLottery, ['prompt' => Yii::t('app', 'Select Promotion Lottery')]) ?>

<?= $form->field($model, 'typeLotteryId')->dropDownList($listDataTypeLottery, ['prompt' => Yii::t('app', 'Select Type Lottery')]) ?>

<?= $form->field($model, 'payment')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>