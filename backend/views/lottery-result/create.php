<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\WinLottery */

$this->title = Yii::t('app','Create Win Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Win Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="win-lottery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
        'listDataLottery' => $listDataLottery,
        'listDataTypeLottery' => $listDataTypeLottery,
    ]) ?>

</div>
