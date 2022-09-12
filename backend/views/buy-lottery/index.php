<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Buy Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'buy-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'number',
            [
                'attribute' => 'typeLotteryId',
                'label' => Yii::t('app','Name Type'),
                'filter' => $listTypeLottery,
                'value' => 'typeLottery.name',
            ],

            [
                'attribute' => 'promotionLotteryId',
                'filter' => $listPromotionLottery,
                'label' => Yii::t('app', 'Promotion Name'),
                'value' => 'payment.promotionLottery.name'
            ],
            'moneyPlay',
            'moneyPay',
            'user.fullName',
            'createdAt',
            [
                'attribute' => 'isTrue',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->isTrue === 1) {
                        $icon = 'glyphicon glyphicon-ok';
                    } elseif ($model->isTrue === 2) {
                        $icon = 'glyphicon glyphicon-remove';
                    } else {
                        $text = '<span style="color: blue">รอผล</span>';
                    }
                    return isset($text) ? $text : '<span class="' . $icon . '" aria-hidden="true">';
                }
            ],
            //'updatedAt',
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>