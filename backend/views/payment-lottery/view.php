<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PaymentLottery */

$this->title = $model->lottery->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'lottery.name',
        'promotionLottery.name',
        'typeLottery.name',
        'payment',
        'discount',
        'createdAt',
        'updatedAt',
    ],
]) ?>