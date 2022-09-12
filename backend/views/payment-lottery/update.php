<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PaymentLottery */

$this->title = Yii::t('app', 'Update Payment Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
    'listDataTypeLottery' => $listDataTypeLottery,
    'listDataLottery' => $listDataLottery,
    'listDataPromotionLottery' => $listDataPromotionLottery,
]) ?>