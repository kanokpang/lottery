<?php

use backend\models\Lottery;
use backend\models\PromotionLottery;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaymentLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Lotteries';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a('Create Payment Lottery', ['/payment-lottery/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'payment-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'lotteryId',
                'value' => 'lottery.name',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'lotteryId',
                    'data' => ArrayHelper::map(Lottery::find()->asArray()->all(), 'id', 'name')
                ]),
            ],
            [
                'attribute' => 'promotionLotteryId',
                'value' => 'promotionLottery.name',
                'filter' => ArrayHelper::map(PromotionLottery::find()->asArray()->all(), 'id', 'name')
            ],
            [
                'attribute' => 'typeLotteryId',
                'label' => Yii::t('app', 'Type Lottery'),
                'filter' => $listTypeLottery,
                'value' => 'typeLottery.name',
            ],
            'payment',
            'discount',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{delete}</div>',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/payment-lottery/view', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/payment-lottery/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/payment-lottery/delete', 'id' => $model->id]);
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