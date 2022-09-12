<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ConditionLottery */

$this->title = Yii::t('app', 'Create Condition Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Condition Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'models' => $models,
    'listData' => $listData,
    'listDataTypeLottery' => $listDataTypeLottery,
]) ?>
