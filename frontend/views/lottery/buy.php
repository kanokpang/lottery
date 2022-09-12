<?php

use backend\models\PromotionLottery;
use yii\grid\GridView;
use yii\widgets\DetailView;

use yii\helpers\Html;

?>
<div class="portlet light portlet-fit ">
    <div class="portlet-title">
        <div class="actions hidden-print">
            <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title=""
               title=""> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="m-heading-1 border-green m-bordered text-center server-timeout">
            <h3 class="font-blue-steel">
                <?= $lottery->name; ?>
            </h3>
            <p class="font-red-mint font-lg p-countdown">
                <span id="countdown" data-countdown="" class="font-red-mint">ปิดรับ: <?= $lottery->endDateTime ?></span>
            </p>
        </div>
        <div class="mt-element-step">
            <div class="row step-thin">
                <div class="col-md-4 bg-grey mt-step-col ">
                    <div class="mt-step-number bg-white font-grey">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">ราคา</div>
                    <div class="mt-step-content font-grey-cascade">เลือกแผนเราคา</div>
                </div>
                <div class=" col-md-4  bg-grey mt-step-col ">
                    <div class="mt-step-number bg-white font-grey"> 2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">เลขหวย</div>
                    <div class="mt-step-content font-grey-cascade">ระบุเลขที่จะแทงและจ่ายเงิน</div>
                </div>
                <div class=" col-md-4  bg-grey  mt-step-col active">
                    <div class="mt-step-number bg-white font-grey"> 3</div>
                    <div class="mt-step-title uppercase font-grey-cascade">ใบสั่งซื้อ</div>
                    <div class="mt-step-content font-grey-cascade">สรุปใบสั่งซื้อ
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
            </div>
            <div class="col-md-6">
                <div class="portlet box grey-cascade">
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
                                ],
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span> ซื้ออีกครั้ง', ['/lottery/index'], ['class' => 'btn btn-primary', 'style' => 'width:150px']) ?>
    </div>
</div>