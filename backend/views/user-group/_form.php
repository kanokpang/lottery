<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\UserGroup */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'userId')->widget(Select2::classname(), [
    'data' => $listDataUser,
    'options' => ['placeholder' => 'Select a full name.', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
    ],
]);
?>

<?= $form->field($model, 'groupId')->widget(Select2::classname(), [
    'data' => $listDataGroup,
    'options' => ['placeholder' => 'Select a group name.'],
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>