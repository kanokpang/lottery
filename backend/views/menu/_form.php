<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\CKEditor;
use iutbay\yii2kcfinder\KCFinder;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'parentId')->dropDownList($listData, ['prompt' => 'Select Sub Menu']) ?>

<?= $form->field($model, 'status')->radioList(['1' => Yii::t('app','Enabled'), '0' => Yii::t('app','Un Enabled')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>