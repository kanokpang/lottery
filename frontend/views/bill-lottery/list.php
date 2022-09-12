<?php

use backend\models\BuyLottery;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Chit Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => Yii::t('app', 'Bill Number'),
                    'attribute' => 'name',
                    'value' => 'name'
                ],
                [
                    'label' => 'Lottery Name',
                    'attribute' => 'idLottery',
                    'filter' => ArrayHelper::map(\backend\models\Lottery::find()->all(),'id','name'),
                    'value' => function ($model) {
                        $lotteryId = $model->buyLottery['lotteryId'];
                        if (Yii::$app->request->get('BillLotterySearch')['idLottery']) {
                            $lotteryId = Yii::$app->request->get('BillLotterySearch')['idLottery'];
                            $lottery = \backend\models\Lottery::findOne(['id' => $lotteryId]);
                            return $lottery->name;
                        } else {
                            $lottery = \backend\models\Lottery::findOne(['id' => $lotteryId]);
                            return $lottery->name;
                        }
                    },
                ],
                'total',
                [
                    'label' => Yii::t('app', 'Total Paid'),
                    'format' => 'html',
                    //center จำนวนเงิน
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function ($model) {
                        $idLotteried = explode(',', $model->idBuyLottery);
                        $buyLotteried = BuyLottery::find()->where(['id' => $idLotteried, 'isTrue' => 1])->all();
                        $total = 0;
                        if ($buyLotteried) {
                            foreach ($buyLotteried as $buyLottery) {
                                $total += $buyLottery->moneyPlay * $buyLottery->payment->payment;
                            }
                        }
                        return $buyLotteried ? $total : '-';

                    }
                ],
                [
                    'label' => Yii::t('app', 'Status'),
                    'format' => 'html',
                    'value' => function ($model) {
                        $idLotteried = explode(',', $model->idBuyLottery);
                        $buyLotteried = BuyLottery::find()->select('isTrue')->where(['id' => $idLotteried])->groupBy('isTrue')->all();
                        $messageTrueOrFalse = '';
                        foreach ($buyLotteried as $buyLottery) {
                            if ($buyLottery->isTrue == 1) {
                                $messageTrueOrFalse .= '<span style="color: green">เล่นได้</span><br>';
                            } elseif ($buyLottery->isTrue == 2) {
                                $messageTrueOrFalse .= '<span style="color: red">เล่นเสีย</span><br>';
                            } else {
                                $messageTrueOrFalse .= '<span style="color: blue">รอผล</span><br>';
                            }
                        }
                        return $messageTrueOrFalse;
                    }
                ],
                'createdAt',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{delete-chit}</div>',
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'visibleButtons' => [
                        'delete-chit' => function ($model) {
                            $idBuyLottery = $model->idBuyLottery;
                            $idBuyLotteried = explode(',', $idBuyLottery);
                            $buyLottery = \backend\models\BuyLottery::find()->where(['id' => $idBuyLotteried])->one();
                            $isAnswer = BuyLottery::find()->select('id')->where(['id' => $idBuyLotteried])->andWhere(['<>', 'isTrue', 0])->count();
                            $endDateTime = $buyLottery->lottery->endDateTime;
                            $endDate = date_format(date_create($endDateTime), "Y-m-d");
                            $now = date('Y-m-d');
                            if ($now > $endDate || $isAnswer) {
                                return false;
                            }
                            return true;
                        }
                    ],
                    'buttons' => [
                        'delete-chit' => function ($url, $model, $key) {
                            $url = \yii\helpers\Url::to(['delete-list', 'id' => $model->id]);
                            return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, ['class' => 'btn btn-default', 'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete chit lottery?'),
                                'method' => 'post',
                            ]
                            ]);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>