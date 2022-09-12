<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */
/* @var $form yii\widgets\ActiveForm */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->title = Yii::t('app', 'Manage Permission Group: {0}', $model->name);
$this->params['breadcrumbs'][] = $this->title;
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'permission')->widget(Select2::classname(), [
    'data' => $listData,
    'options' => ['placeholder' => 'Select a permission.', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
    ],
]);
?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>