<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootballSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-football-search">

    <?php $form = ActiveForm::begin([
        'action' => [Yii::$app->controller->action->id],
        'method' => 'get',
        'enableClientValidation' => false
    ]); ?>

    <?= $form->field($model, 'leagueId')->widget(Select2::classname(), [
        'data' => $listDataLeagueFootball,
        'options' => ['placeholder' => Yii::t('app','Select League Football')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'team')->widget(Select2::classname(), [
        'data' => $listDataTeamFootball,
        'options' => ['placeholder' => Yii::t('app','Select Team Football')],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'startMatch')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => Yii::t('app','Enter select date match')],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
