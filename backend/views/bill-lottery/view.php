<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BillLottery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bill Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-lottery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'createdAt',
        ],
    ]) ?>

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
            [
                'label' => Yii::t('app', 'Type Name'),
                'value' => function ($buyLotterys) {
                    $typeLottery = \backend\models\TypeLottery::findOne(['id' => $buyLotterys['typeLotteryId']]);
                    return $typeLottery->name;
                }
            ],
            [
                'attribute' => 'moneyPlay',
                'footer' => $totalMoneyPlay
            ],
            [
                'attribute' => 'moneyPay',
                'footer' => $totalMoneyPay
            ],
            [
                'label' => Yii::t('app', 'Promotion Name'),
                'value' => function ($buyLotterys) {
                    $payment = \backend\models\PaymentLottery::findOne(['id' => $buyLotterys['paymentId']]);
                    return $payment->promotionLottery->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Full Name'),
                'value' => function ($buyLotterys) {
                    $user = \common\models\User::findOne(['id' => $buyLotterys['userId']]);
                    return $user->fullName;
                }
            ],
            'createdAt',
        ],
    ]); ?>

</div>
