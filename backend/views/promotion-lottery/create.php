<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PromotionLottery */

$this->title = Yii::t('app', 'Create Promotion Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promotion Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'models' => $models,
]) ?>