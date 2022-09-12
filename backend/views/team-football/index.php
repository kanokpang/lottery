<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeamFootballSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Team Footballs');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Team Football'), ['/team-football/create'], ['class' => 'btn btn-success']) ?>
</p>

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
                'label' => Yii::t('app', 'Logo'),
                'format' => 'html',
                'value' =>  function ($model) {
                    return Html::img($model->photoViewer, ['width' => '100', 'height' => '100']);
                }
            ],
            'name',
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/team-football/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/team-football/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => ['method' => 'post'],
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
