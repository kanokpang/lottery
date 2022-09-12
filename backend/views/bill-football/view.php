<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BillLottery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bill Football'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-lottery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => Yii::t('app', 'League'),
                'value' => function ($model) {
                    return $model->buy->match->league->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Match Name'),
                'value' => function ($model) {
                    return $model->buy->match->team1->name . '-' . $model->buy->match->team2->name;
                },
            ],
            [
                'label' => Yii::t('app', 'Team Buy'),
                'value' => function ($model) {
                    return $model->buy->teamWinByMatchId === 1 ? $model->buy->match->team1->name : $model->buy->match->team2->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Total Play'),
                'value' => function ($model) {
                    return $model->buy->moneyPlay;
                }
            ],
            [
                'label' => Yii::t('app', 'Rate Play'),
                'value' => function ($model) {
                    return $model->buy->rate;
                }
            ],
            [
                'label' => Yii::t('app', 'Total'),
                'value' => function ($model) {
                    return $model->buy->moneyPlay * $model->buy->rate;
                }
            ],
            [
                'label' => Yii::t('app', 'Full Time / First Time'),
                'value' => function ($model) {
                    return $model->buy->isFullTime ? Yii::t('app', 'Full Time') : Yii::t('app', 'First Time');
                }
            ],
            [
                'label' => Yii::t('app', 'Status'),
                'format' => 'html',
                'value' => function ($model) {
                    $messageTrueOrFalse = '';
                    if ($model->buy->isTrue == 1) {
                        $messageTrueOrFalse .= '<span style="color: green">เล่นได้</span><br>';
                    } elseif ($model->buy->isTrue == 2) {
                        $messageTrueOrFalse .= '<span style="color: red">เล่นเสีย</span><br>';
                    } else {
                        $messageTrueOrFalse .= '<span style="color: blue">รอผล</span><br>';
                    }
                    return $messageTrueOrFalse;
                }
            ],
            'createdAt',
        ],
    ]) ?>

</div>
