<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php
$form = ActiveForm::begin([]); ?>
<?= $form->field($model, 'typeLotteryId')->dropDownList($listData, ['prompt' => Yii::t('app', 'Choose Select')]) ?>

<?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'moneyPlay')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save Phoy'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
