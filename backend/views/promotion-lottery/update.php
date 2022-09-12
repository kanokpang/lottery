<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PromotionLottery */

$this->title = Yii::t('app', 'Update Promotion Lottery: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promotion Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
]) ?>