<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PaymentLottery */

$this->title = Yii::t('app', 'Create Payment Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'models' => $models,
    'listDataTypeLottery' => $listDataTypeLottery,
    'listDataLottery' => $listDataLottery,
    'listDataPromotionLottery' => $listDataPromotionLottery,
]) ?>