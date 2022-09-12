<?php

/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */

$this->title = Yii::t('app', 'Update Transfer Money: {0}', $model->transactionNumber);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transfer Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
    'listBankOwner' => $listBankOwner,
    'permissionName' => $permissionName,
    'listChanelBank' => $listChanelBank,
]) ?>