<?php

use backend\models\PaymentLottery;
use backend\models\PromotionLottery;
use backend\models\User;
use kartik\tabs\TabsX;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->registerCssFile(Yii::getAlias('@web/themes/lottery/css/pricing.min.css'));
echo Yii::t('app', 'Save');
?>
<div class="page-content-inner">
    <div class="portlet light portlet-fit ">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-red bold uppercase"><?= $lottery->name ?> </span>
            </div>
            <div class="actions hidden-print">
                <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title=""
                   title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="m-heading-1 border-green m-bordered text-center server-timeout">
                <h3 class="font-blue-steel">
                    หวยรัฐบาล
                </h3>
                <p class="font-red-mint font-lg p-countdown">
                    <span id="countdown" data-countdown="" data-reload="false"
                          class="font-red-mint">ปิดรับ <?= $lottery->endDateTime ?></span>
                </p>
            </div>
            <div class="mt-element-step">
                <div class="row step-thin">
                    <div class="col-md-4 bg-grey mt-step-col  active ">
                        <div class="mt-step-number bg-white font-grey">1</div>
                        <div class="mt-step-title uppercase font-grey-cascade">ราคา</div>
                        <div class="mt-step-content font-grey-cascade">เลือกแผนเราคา
                        </div>
                    </div>
                    <div class=" col-md-4  bg-grey mt-step-col ">
                        <div class="mt-step-number bg-white font-grey"> 2</div>
                        <div class="mt-step-title uppercase font-grey-cascade">เลขหวย</div>
                        <div class="mt-step-content font-grey-cascade">ระบุเลขที่จะแทงและจ่ายเงิน</div>
                    </div>
                    <div class=" col-md-4  bg-grey  mt-step-col ">
                        <div class="mt-step-number bg-white font-grey"> 3</div>
                        <div class="mt-step-title uppercase font-grey-cascade">ใบสั่งซื้อ</div>
                        <div class="mt-step-content font-grey-cascade">สรุปใบสั่งซื้อ
                        </div>
                    </div>
                </div>
            </div>
            <div class="pricing-content-2">
                <div class="pricing-table-container">
                    <div class="row padding-fix">
                        <?php foreach ($promotions as $key => $promotion) {
                            $command = Yii::$app->db->createCommand("SELECT sum(discount) FROM " . PaymentLottery::tableName() . "WHERE promotionLotteryId =" . $promotion['id'] . " and lotteryId =" . $lotteryId);
                            $sum = $command->queryScalar();
                            $query = PaymentLottery::find()->where([
                                'lotteryId' => $lotteryId,
                                'promotionLotteryId' => $promotion['id']
                            ]);
                            $dataProvider = new ActiveDataProvider([
                                'query' => $query,
                            ]);
                            $items[] = [
                                'label' => $promotion['name'],
                                'content' => $this->render('payment-promotion', [
                                    'dataProvider' => $dataProvider,
                                ]),
                            ];
                            ?>
                            <div class="col-md-3 no-padding">
                                <div class="price-column-container  border-right border-left  border-top ">
                                    <div class="price-table-head padding-bottom-20">
                                        <a href="<?= Url::to(['lottery/order',
                                            'id' => $lotteryId,
                                            'promotionId' => $promotion['id']]); ?>"
                                           class="btn btn-lg grey-salsa btn-outline sbold bold uppercase">
                                            เลือก
                                        </a>
                                    </div>
                                    <div class="price-table-head price-1">
                                        <h2 class="uppercase no-margin"><?= $promotion['name']; ?></h2>
                                    </div>
                                    <div class="price-table-pricing">
                                        <h3>
                                            <?= $sum; ?><span class="font-md">%</span></h3>
                                        <p class="uppercase">ส่วนลดรวม</p>
                                    </div>
                                    <div class="price-table-content">
                                        <div class="row no-margin hidden-md hidden-lg">
                                            <div class="col-xs-12 ">
                                                <button type="button"
                                                        class="btn btn-xs btn-default btn-outline sbold bold uppercase"
                                                        onclick="showDiscountDetail('r1')">
                                                    ดูรายละเอียด
                                                </button>
                                            </div>
                                        </div>
                                        <div class="hidden-sm hidden-xs" id="price-detail-r1">
                                            <?php foreach ($typeLotterys as $typeLottery) {
                                                $paymentLottery = PaymentLottery::find()->where([
                                                    'promotionLotteryId' => $promotion['id'],
                                                    'typeLotteryId' => $typeLottery['id'],
                                                    'lotteryId' => $lotteryId
                                                ])->one();
                                                if ($paymentLottery) {

                                                    ?>
                                                    <div class="row no-margin">
                                                        <div class="col-xs-9 text-left uppercase"><?= $typeLottery['name'] ?></div>
                                                        <div class="col-xs-3 text-left">
                                                            <b><?= $paymentLottery->discount ?>%</b>
                                                        </div>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet light portlet-fit ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-usd font-blue-steel"></i>
                <span class="caption-subject font-blue-steel bold uppercase">ราคาจ่าย</span>
            </div>
            <div class="actions">
                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                   data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <?php
                echo TabsX::widget([
                    'items' => $items,
                    'position' => TabsX::POS_LEFT,
                    'encodeLabels' => false
                ]); ?>
            </div>
        </div>
    </div>
</div>