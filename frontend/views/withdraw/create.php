<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */
/* @var $form yii\widgets\ActiveForm */
$this->registerCssFile('@web/css/components-md.min.css');

?>
<div class="portlet light mt-element-ribbon" id="form_wizard_1">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-red bold uppercase"> <?= Yii::t('app', 'Withdraw Moneys') ?></span>
        </div>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <h3>บัญชีผู้ถอน: <?= $user->bank->name ?> - <?= $user->numberBank ?></h3>
    <h4 style="color: red;">หมายเหตุ! ถอนขั้นต่ำ 200 บาทขึ้นไป</h4>

    <?= $form->field($model, 'money')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Confirm', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>