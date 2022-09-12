<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConditionLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Condition Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Condition Lottery'), ['/condition-lottery/create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="table-responsive">
    <?php Pjax::begin(['id' => 'condition-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'number',
            'condition',
            'limit',
            'lottery.name',
            'typeLottery.name',
            [
                'label' => Yii::t('app', 'Is Purchase'),
                'value' => function ($model) {
                    return $model->isPurchaseLimit ? Yii::t('app', Yii::t('app', 'Purchase Limit'))
                        : Yii::t('app', 'Not for sale');
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{delete}</div>',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/condition-lottery/view', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/condition-lottery/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/condition-lottery/delete', 'id' => $model->id]);
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
    <?php Pjax::end() ?>
</div>
