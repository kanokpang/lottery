<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\CKEditor;
use iutbay\yii2kcfinder\KCFinder;

/* @var $this yii\web\View */
/* @var $model backend\models\Information */
/* @var $form yii\widgets\ActiveForm */

$kcfOptions = array_merge(KCFinder::$kcfDefaultOptions, [
    'uploadURL' => Yii::getAlias('@web') . '/upload',
    'access' => [
        'files' => [
            'upload' => true,
            'delete' => true,
            'copy' => false,
            'move' => false,
            'rename' => false,
        ],
        'dirs' => [
            'create' => true,
            'delete' => false,
            'rename' => false,
        ],
    ],
]);
Yii::$app->session->set('KCFINDER', $kcfOptions);
?>
<h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'menuId')->dropDownList($listData, ['prompt' => 'Select Menu', 'onchange'=>'
window.location.href = "'.\yii\helpers\Url::to(['information/update']).'?id="+$(this).val()'
]) ?>

<?= $form->field($model, 'detail')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'full'
]) ?>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end();
?>

