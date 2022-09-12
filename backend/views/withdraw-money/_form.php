<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WithdrawMoney */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'userId')->widget(Select2::className(), [
    'data' => $listData,
    'options' => ['placeholder' => Yii::t('app','Select a user')],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>

<?= $form->field($model, 'money')->textInput() ?>

<?= $form->field($model,'detail')->textarea(['cols' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>