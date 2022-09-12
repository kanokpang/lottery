<?php

/* @var $this yii\web\View */

$this->registerCssFile('@web/css/adminLTE.min.css');
$this->registerCssFile('@web/css/ionicons.min.css');
$this->title = Yii::t('app', 'Dashboard 3');
?>
<div class="site-index">
    <h2><?= $this->title; ?></h2>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $countUserTrue ?></h3>

                <p><?= Yii::t('app', 'Total User True Lottery') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-user-circle" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?= $countBillLotteryTrue ?></h3>

                <p><?= Yii::t('app', 'Total Bill True') ?></p>
            </div>
            <div class="icon" style="top: -43px">
                <i class="fa fa-user-circle-o" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= number_format($expensesLastLottery, 2) ?></h3>

                <p><?= Yii::t('app', 'Expenses Last Lottery') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-shopping-bag" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= isset($totalMoneyPay->moneyPay) ? number_format($totalMoneyPay->moneyPay, 2) : 0 ?></h3>

                <p><?= Yii::t('app', 'Benefit') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-btc" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= number_format($expenses, 2) ?></h3>

                <p><?= Yii::t('app', 'Expense') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-credit-card" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
