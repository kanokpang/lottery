<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypeLottery */

$this->title = Yii::t('app', 'Update Type Lottery: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
]) ?>