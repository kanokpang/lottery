<?php

use frontend\modules\CKEditor;
use iutbay\yii2kcfinder\KCFinder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AnswerIssue */
/* @var $form yii\widgets\ActiveForm */

$kcfOptions = array_merge(KCFinder::$kcfDefaultOptions, [
    'uploadURL' => Yii::getAlias('@web') . '/uploads/'.Yii::$app->user->id,
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

<div class="answer-issue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
