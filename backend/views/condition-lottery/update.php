<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ConditionLottery */

$this->title = Yii::t('app', 'Update Condition Lottery: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Condition Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
    'listData' => $listData,
    'listDataTypeLottery' => $listDataTypeLottery,
]);
?>