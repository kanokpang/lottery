<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TeamFootball */
/* @var $form yii\widgets\ActiveForm */
$this->title = Yii::t('app', 'Update User Status: {0}', $model->fullName);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'status')->dropDownList($model->getItemStatus(), ['prompt' => Yii::t('app', 'Select Status')]); ?>

<?= $form->field($model, 'note')->textarea(['cols' => '6']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>