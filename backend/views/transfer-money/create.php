<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */

$this->title = Yii::t('app', 'Create Transfer Money');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transfer Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'listBankOwner' => $listBankOwner,
    'listChanelBank' => $listChanelBank,
    'listDataUser' => $listDataUser
]) ?>