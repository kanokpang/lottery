<?php

use backend\models\BuyFootball;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ResultFootballSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Result Footballs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="result-football-index">
    <?php Pjax::begin(['id' => 'result-football']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app', 'Match'),
                'value' => function ($model) {
                    return $model->match->team1->name. '-' .$model->match->team2->name;
                }
            ],
            [
                'attribute' => 'teamWinByMatchId',
                'label' => Yii::t('app', 'Team Win'),
                'filter' => $listTeamFootball,
                'value' => function ($model) {
                    return $model->teamWin->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Type Answer Match'),
                'attribute' => 'type',
                'filter' => [1 => Yii::t('app', 'HDP'), 2 => Yii::t('app', 'Over'), 3 => Yii::t('app', 'HxA')],
                'value' => function ($model) {
                    if ($model->type === 1) {
                        $typeMatch = 'HDP';
                    } elseif ($model->type === 2) {
                        $typeMatch = 'OVER';
                    } else {
                        $typeMatch = 'HxA';
                    }
                    return $typeMatch;
                }
            ],
            [
                'label' => Yii::t('app', 'FullTime / FirstTime'),
                'attribute' => 'isFullTime',
                'filter' => [1 => Yii::t('app', 'Full Time'), 0 => Yii::t('app', 'First Time')],
                'value' => function ($model) {
                    return $model->isFullTime ? Yii::t('app', 'Full Time') : Yii::t('app', 'First Time');
                }
            ],
            [
                'label' => Yii::t('app', 'Full Name'),
                'value' => function ($model) {
                    return $model->user->fullName;
                }
            ],
            [
                'attribute' => 'answer',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->isAnswer === 0 ? '<span style="color: red">' . Yii::t('app', 'Not Answer') . '</span>'
                        : '<span style="color:blue">' . Yii::t('app', 'Answer') . '</span>';
                }
            ],
            'createdAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'delete' => function ($model) {
                        return intval($model->isAnswer) === 0;
                    },
                    'answer' => function ($model) {
                        return intval($model->isAnswer) === 0;
                    }
                ],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{answer}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons' => [
                    'answer' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/result-football/answer', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to answer football?'),
                                'method' => 'post'
                            ]
                        ];
                        return Html::a(Yii::t('app', 'Answer'), $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/result-football/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete result football?'),
                                'method' => 'post'
                            ]
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
