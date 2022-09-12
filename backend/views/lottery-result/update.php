<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\WinLottery */

$this->title = Yii::t('app','Update Win Lottery: {0}', $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Win Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="win-lottery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'listDataLottery' => $listDataLottery,
        'listDataTypeLottery' => $listDataTypeLottery
    ]) ?>

</div>
