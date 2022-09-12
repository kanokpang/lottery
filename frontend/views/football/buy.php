<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootball */

$this->title = $model->team1->name . ' - ' . $model->team2->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= $this->title; ?></span>
        </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => Yii::t('app', 'League'),
                'value' => function ($model) {
                    return $model->league->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Team Home'),
                'value' => function ($model) {
                    return $model->team1->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Team Away'),
                'value' => function ($model) {
                    return $model->team2->name;
                }
            ],
            'hdpFirstTime',
            'homeFirstTime',
            'awayFirstTime',
            'goalFirstTime',
            'overFirstTime',
            'underFirstTime',
            'hdpFullTime',
            'homeFullTime',
            'awayFullTime',
            'goalFullTime',
            'overFullTime',
            'underFullTime',
        ],
    ]) ?>
</div>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Buy Football') ?></span>
        </div>
    </div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($buyFootball, 'teamWinByMatchId')->radioList([
        $model->teamId1 => $model->team1->name,
        $model->teamId2 => $model->team2->name
    ]) ?>

    <?= $form->field($buyFootball, 'moneyPlay')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
