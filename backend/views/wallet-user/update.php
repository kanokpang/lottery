<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WalletUser */

$this->title = Yii::t('app','Update Wallet User: {nameAttribute}');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Wallet Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wallet-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listData' => $listData,
    ]) ?>

</div>
