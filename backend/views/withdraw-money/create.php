<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WithdrawMoney */

$this->title = Yii::t('app','Create Withdraw Money');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Withdraw Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <?= $this->render('_form', [
        'model' => $model,
        'listData' => $listData,
    ]) ?>