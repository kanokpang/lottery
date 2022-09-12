<?php

use kartik\date\DatePicker;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'profileImage')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'allowedFileExtensions' => ['jpg', 'png'],
        'initialPreview' => $model->getPhotoViewer(),
        'initialPreviewAsData' => true,
        'showUpload' => false
    ],
]); ?>

<?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'birthDate')->widget(DatePicker::classname(), [
    'language' => 'th',
    'options' => ['placeholder' => Yii::t('app', 'Select birth date')],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd'
    ]
]); ?>

<?= $form->field($model, 'address')->textArea() ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password_hash')->passwordInput() ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'bankId')->dropDownList($listData, ['prompt' => Yii::t('app', 'Choose Select')]) ?>

<?= $form->field($model, 'numberBank')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'lineId')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>