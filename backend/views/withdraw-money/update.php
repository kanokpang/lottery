<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WithdrawMoney */

$this->title = Yii::t('app', 'Update Withdraw Money: {0}', $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Withdraw Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_form', [
    'model' => $model,
    'listData' => $listData,
]) ?>