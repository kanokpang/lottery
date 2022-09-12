<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BankOwner */
/* @var $form yii\widgets\ActiveForm */
?>
<h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'accountName')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'status')->dropDownList([
    '1' => Yii::t('app', 'Active'),
    '0' => Yii::t('app', 'In Active')]) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
