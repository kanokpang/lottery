<?php

use kartik\select2\Select2;
use kartik\widgets\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?php if(isset($listDataUser)) {
    echo $form->field($model, 'userId')->widget(Select2::className(), [
        'data' => $listDataUser,
        'options' => ['placeholder' => Yii::t('app','Select a user')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
} ?>

<?= $form->field($model, 'bankOwnerId')->dropDownList($listBankOwner, ['prompt' => Yii::t('app', 'Select Bank')]) ?>

<?= $form->field($model, 'money')->textInput() ?>

<?= $form->field($model, 'transactionDate')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => Yii::t('app', 'Select transaction date')],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'php:Y-m-d H:i:00',
        'todayHighlight' => true
    ]
]); ?>

<?= $form->field($model, 'chanelBankId')->dropDownList($listChanelBank, ['prompt' => Yii::t('app','Select Chanel Bank')]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>