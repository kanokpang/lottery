<?php

use kartik\file\FileInput;
use kartik\widgets\DateTimePicker;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .file-drop-zone{
        height: 50%;
    }
</style>
<div class="portlet light mt-element-ribbon" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-red bold uppercase"> <?= Yii::t('app', 'Transfer Moneys') ?></span>
        </div>
    </div>
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <h3>บัญชีผู้ฝาก: <?= $user->bank->name ?> - <?= $user->numberBank ?></h3>
    <h4 style="color: red;">หมายเหตุ! ฝากขั้นต่ำ 200 บาทขึ้นไป</h4>
    <?= $form->field($model, 'bankOwnerId')->dropDownList($listBankOwner, ['prompt' => Yii::t('app', 'Select Bank')]) ?>

    <?= $form->field($model, 'chanelBankId')->dropDownList($listChanelBank, ['prompt' => Yii::t('app', 'Select Chanel Bank')]); ?>

    <?= $form->field($model, 'money')->textInput() ?>

    <?= $form->field($model, 'transactionDate')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => Yii::t('app', 'Select transaction date')],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'php:Y-m-d H:i:00',
            'todayHighlight' => true
        ]
    ]); ?>
    <span style="color: red">วันที่ทำรายการดูจากสลิปรายการโอนเงิน วว/ดด/ปป เวลา xx:xx</span>

    <?= $form->field($noteTransferMoney, 'photos[]')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'initialPreview' => $noteTransferMoney->getPhotosViewer(),
            'allowedFileExtensions' => ['jpg', 'png'],
            'initialPreviewAsData' => true,
            'maxFileCount' => 5,
            'showRemove' => true,
            'showUpload' => false
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>