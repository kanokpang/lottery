<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootballSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="match-football-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'leagueId') ?>

    <?= $form->field($model, 'teamId1') ?>

    <?= $form->field($model, 'teamId2') ?>

    <?= $form->field($model, 'scoreTeam1') ?>

    <?php // echo $form->field($model, 'scoreTeam2') ?>

    <?php // echo $form->field($model, 'detail') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'startMatch') ?>

    <?php // echo $form->field($model, 'endMatch') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
