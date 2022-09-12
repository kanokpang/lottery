<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootball */

$this->title = $model->team1->name . ' - ' . $model->team2->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        [
            'label' => Yii::t('app', 'Event'),
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
        'scoreTeam1',
        'scoreTeam2',
        'startMatch',
        'endMatch',
        'startBuy',
        'endBuy',
        'hdpFirstTime',
        'homeFirstTime',
        'awayFirstTime',
        'goalFirstTime',
        'rangeOverFirstTime',
        'overFirstTime',
        'underFirstTime',
        'homeWinFirstTime',
        'awayWinFirstTime',
        'drawWinFirstTime',
        'hdpFullTime',
        'homeFullTime',
        'awayFullTime',
        'goalFullTime',
        'overFullTime',
        'underFullTime',
        'rangeOverFullTime',
        'homeWinFullTime',
        'awayWinFullTime',
        'drawWinFullTime',
        'createdAt',
        'updatedAt',
    ],
]) ?>
