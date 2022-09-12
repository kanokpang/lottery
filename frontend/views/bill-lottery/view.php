<?php

use backend\models\BuyLottery;
use backend\models\PromotionLottery;
use yii\bootstrap\Button;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BillLottery */

$this->title = $model->name . ' ' . $lotteryName;
$this->params['breadcrumbs'][] = ['label' => 'Bill Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="portlet  green-meadow  box">
            <div class="portlet-title">
                <div class="caption">รายละเอียดโพย</div>
            </div>

			

            <div class="portlet-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        [
                            'label' => Yii::t('app', 'promotion'),
                            'value' => function () use ($promotionLotteryId) {
                                $promotion = PromotionLottery::findOne(['id' => $promotionLotteryId]);
                                return $promotion->name;
                            }
                        ],
                        'createdAt',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <?php
        $idBuyLottery = $model->idBuyLottery;
        $idBuyLotteried = explode(',', $idBuyLottery);
        $buyLottery = \backend\models\BuyLottery::find()->where(['id' => $idBuyLotteried])->one();
        $isAnswer = BuyLottery::find()->select('id')->where(['id' => $idBuyLotteried])->andWhere(['<>', 'isTrue', 0])->count();
        $endDateTime = $buyLottery->lottery->endDateTime;
        $endDate = date_format(date_create($endDateTime), "Y-m-d");
        $now = date('Y-m-d');
        ?>
    </div>
    <div class="col-md-12">
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption">สรุปใบโพย</div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'showFooter' => TRUE,
                        'footerRowOptions' => ['style' => 'color:red;font-weight:bold;text-decoration: underline;'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'footer' => Yii::t('app', 'Total')
                            ],

                            'number',
                            'typeLottery.name',
                            [
                                'attribute' => 'moneyPlay',
                                'footer' => $totalMoneyPlay
                            ],
                            [
                                'attribute' => 'moneyPay',
                                'footer' => $totalMoneyPay
                            ],
                            [
                                'label' => Yii::t('app', 'Discount'),
                                'value' => 'payment.discount',
                            ],
                            [
                                'label' => Yii::t('app', 'Status'),
                                'format' => 'html',
                                'value' => function ($model) {
                                    $message = '';
                                    if ($model['isTrue'] == 1) {
                                        $message .= '<span style="color: green">เล่นได้</span><br>';
                                    } elseif ($model['isTrue'] == 2) {
                                        $message .= '<span style="color: red">เล่นเสีย</span><br>';
                                    } else {
                                        $message .= '<span style="color: blue">รอผล</span><br>';
                                    }
                                    return $message;
                                }
                            ],
                        ],
                    ]); ?>
                </div>
                <div class="row">
                <div class="col-md-offset-8 col-md-4">
                    <div class="caption"
                         style="background-color: #B9f7D3; height: 120px; padding-top: 10px;">
                        <h4 align="right"><?= Yii::t('app', 'Total Play: {0}', $totalMoneyPlay) ?></h4>
                        <h4 align="right"><?= Yii::t('app', 'All Discounts: {0}', $allResult) ?></h4>
                        <?php $netPrices = $totalMoneyPlay - $allResult; ?>
                        <h4 align="right"><?= Yii::t('app', 'Net Prices: {0}', $netPrices) ?></h4>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-title tabbable-line">
    </div>
    <?php
    if ($endDate > $now ||  !$isAnswer) {
        echo Button::widget([
            'label' => Yii::t('app', 'delete before date {0}', $endDate),
            'options' => ['class' => 'btn-danger',
                'href' => Url::to(["bill-lottery/delete-list", 'id' => $model->id]),
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete chit lottery?'),
                    'method' => 'post'
                ]
            ],
        ]);
    }
    ?>

</div>
