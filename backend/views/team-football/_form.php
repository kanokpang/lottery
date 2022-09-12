<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TeamFootball */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'logo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'allowedFileExtensions' => ['jpg', 'png'],
        'initialPreview' => $model->getPhotoViewer(),
        'initialPreviewAsData' => true,
        'showUpload' => false
    ],
]); ?>

<?= $form->field($model, 'leagueId')->dropDownList($listLeagueFootball, ['prompt' => Yii::t('app','Select League')]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>