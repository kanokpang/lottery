<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Lottery */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'startDateTime')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => Yii::t('app', 'Select start date time')],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'php:Y-m-d H:i:s',
        'todayHighlight' => true
    ]
]); ?>

<?= $form->field($model, 'endDateTime')->widget(DateTimePicker::classname(), [
    'options' => ['placeholder' => Yii::t('app', 'Select end date time')],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'php:Y-m-d H:i:s',
        'todayHighlight' => true
    ]
]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>