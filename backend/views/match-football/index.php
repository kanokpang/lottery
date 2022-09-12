<?php

use backend\models\ResultFootball;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MatchFootballSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Match Footballs');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Match Football'), ['/match-football/create'], ['class' => 'btn btn-success']) ?>
</p>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app', 'League Name'),
                'value' => 'league.name',
            ],
            [
                'label' => Yii::t('app', 'Team Home'),
                'value' => 'team1.name'
            ],
            [
                'label' => Yii::t('app', 'Team Away'),
                'value' => 'team2.name'
            ],
            'scoreTeam1',
            'scoreTeam2',
            'startMatch',
            'endMatch',
            [
                'label' => Yii::t('app', 'Status'),
                'value' => function ($model) {
                    $isAnswer = ResultFootball::find()->where(['matchId' => $model->id])->count();
                    return $isAnswer ? Yii::t('app', 'Answer') : Yii::t('app', 'Not Answer');
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{score}{update}{result}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
				'visibleButtons' => [
                    'result' => function ($model) {
                        $endDate = date_format(date_create($model->endBuy), "Y-m-d");
                        $now = date('Y-m-d');
                        if ($now >= $endDate) {
                            return true;
                        }
                        return false;
                    }
                ],
                'buttons' => [
                    'score' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/match-football/score', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a(Yii::t('app', 'Score'), $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/match-football/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/match-football/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => ['method' => 'post'],
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
					'result' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/match-football/result', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a(Yii::t('app', 'Result'), $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>