<?php

/* @var $this yii\web\View */

use kartik\select2\Select2;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile('@web/css/adminLTE.min.css');
$this->registerCssFile('@web/css/ionicons.min.css');
$this->title = Yii::t('app', 'Charts');
?>
<div class="site-index">
    <h2><?= $this->title; ?></h2>
    <?php
    $categories = [];
    $count = [];
    foreach ($data as $value) {
        $categories[] = $value['number'];
        $count[] = intval($value['count']);
    }
    $countBill = [];
    $countBillMutilple = [];
    foreach ($dataBillLottery as $value) {
        $countBillMutilple[] = [
            $countBill[] = $value['firstName'] . ' ' . $value['lastName'],
            $countBill[] = intval($value['count']),
        ];
    }
    $categoriesUser = [];
    $series = [];
    foreach ($dataUserBillLottery as $dataUserBill) {
        $categoriesUser[] = $dataUserBill['firstName'].' '.$dataUserBill['lastName'];
        $series = ['name' => 'จำนวนเงิน', 'data' => [intval($dataUserBill['totalPaid'])]];
    }
    ?>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= number_format($totalMoneyPay, 2) ?></h3>
                <p><?= Yii::t('app', 'Total Profit') ?></p>
            </div>
            <div class="icon" style="top: -43px !important;">
                <i class="fa fa-btc" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $countNewOrder ?></h3>

                <p><?= Yii::t('app', 'New Orders') ?></p>
            </div>
            <div class="icon" style="top: -43px !important;">
                <i class="fa fa-cart-plus" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $countUserAgentWeek ?></h3>

                <p><?= Yii::t('app', 'User Agent') ?></p>
            </div>
            <div class="icon" style="top: -43px !important;">
                <i class="fa fa-user-plus" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= $countUserNormalWeek ?></h3>

                <p><?= Yii::t('app', 'User Normal') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-user-o" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-12">
        <?php
        ActiveForm::begin([
            'method' => 'GET',
            'action' => Url::to(['index']),
        ]);
        ?>
        <div class="col-md-offset-3 col-md-4">
            <?php
            echo '<label class="control-label">' . Yii::t('app', 'Select Lottery') . '</label> ';
            echo Select2::widget([
                'name' => 'lotteryId',
                'data' => $listLottery,
                'value' => $lotteryId,
                'language' => 'th',
                'options' => ['placeholder' => Yii::t('app', 'Select Lottery')],
            ]);
            ?>
        </div>
        <div class="col-md-4" style="margin-top: 20px;">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary', 'style' => 'margin: 5px;']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <?php echo Highcharts::widget([
            'options' => [
                'title' => [
                    'text' => Yii::t('app','Total Lottery By Number Limit 10'),
                ],
                'xAxis' => [
                    'categories' => $categories
                ],
                'credits' => [
                    'enabled' => false
                ],
                'yAxis' => ['title' => [
                    'text' => 'จำนวน']
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'จำนวน',
                        'data' => $count,
                        'colorByPoint' => 'true',
                    ],
                ],
            ]
        ]); ?>
    </div>
    <div class="col-md-6">
    <?php echo Highcharts::widget([
        'options' => [
            'chart' => [
                'plotBackgroundColor' => null,
                'plotBorderWidth' => null,
                'plotShadow' => false,
                'type' => 'pie',
            ],
            'title' => [
                'text' => Yii::t('app', 'Total Bill Limit 10'),
            ],
            'tooltip' => [
                'pointFormat' => '<b>{point.name}</b>:จำนวน {point.y} บิล'
            ],
            'plotOptions' => [
                'pie' => [
                    'allowPointSelect' => true,
                    'cursor' => 'point',
                    'dataLabels' => [
                        'enabled' => true,
                        'format' => '<b>{point.name}</b>:จำนวน {point.y} บิล'
                    ]
                ],
            ],
            'series' => [
                [
                    'type' => 'pie',
                    'colorByPoint' => true,
                    'name' => 'จำนวน',
                    'data' => $countBillMutilple
                ],
            ],
        ]
    ]); ?>
    </div>
    <div class="col-md-6">
        <?= Highcharts::widget([
            'options' => [
                'chart' => ['type' => 'bar'],
                'title' => ['text' => Yii::t('app', 'Maximum purchase lottery amount')],
                'xAxis' => [
                    'categories' => $categoriesUser
                ],
                'yAxis' => [
                    'title' => ['text' => Yii::t('app','Total Paid By User')]
                ],
                
                'series' => [
                    $series
                ]
            ]
        ]);
        ?>
    </div>
</div>
