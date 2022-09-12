<?php

use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<div class="row">
    <div class="table-responsive">
        <div class="col-md-12">
            <?=
            $this->render('_search', [
                'searchModel' => $searchModel,
                'listData' => $listData,
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= GridView::widget([
                'id' => 'grid-recive',
                'dataProvider' => $dataProviderLotteryRecive,
                'filterModel' => $searchModel,
                'toolbar' => [
                    ['content' => ''],
                    '{export}',
                    '{toggleData}',
                ],
                // set export properties
                'export' => [
                    'fontAwesome' => true
                ],
                'panel' => [
                    'type' => GridView::TYPE_SUCCESS,
                    'heading' => Yii::t('app', 'Report Lottery Recive')
                ],
                'showPageSummary' => true,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],

                    [
                        'attribute' => 'number',
                        'pageSummary' => Yii::t('app', 'Total'),
                    ],
                    'typeLottery.name',
                    [
                        'attribute' => 'moneyPlay',
                        'format' => ['decimal', 2],
                        'pageSummary' => true
                    ],
                    [
                        'attribute' => 'moneyPay',
                        'format' => ['decimal', 2],
                        'pageSummary' => true,
                        'pageSummaryFunc' => GridView::F_SUM,
                    ],
                    'payment.promotionLottery.name',
                    'user.fullName',
                    'createdAt',
                ],
                //'showFooter' => true,
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= GridView::widget([
                'id' => 'grid-pay',
                'dataProvider' => $dataProviderLotteryPay,
                'toolbar' => [
                    ['content' => ''],
                    '{export}',
                    '{toggleData}',
                ],
                // set export properties
                'export' => [
                    'fontAwesome' => true
                ],
                'panel' => [
                    'type' => GridView::TYPE_DANGER,
                    'heading' => Yii::t('app', 'Report Lottery Pay')
                ],
                'showPageSummary' => true,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],

                    [
                        'attribute' => 'number',
                        'pageSummary' => Yii::t('app', 'Total'),
                    ],
                    'typeLottery.name',
                    [
                        'attribute' => 'moneyPlay',
                        'format' => ['decimal', 2],
                        'pageSummary' => true
                    ],
                    [
                        'attribute' => 'moneyPay',
                        'format' => ['decimal', 2],
                        'pageSummary' => true
                    ],
                    'payment.promotionLottery.name',
                    'user.fullName',
                    'createdAt',
                ],
              //  'showFooter' => true,
            ]); ?>
        </div>
    </div>
</div>