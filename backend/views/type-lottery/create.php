<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypeLottery */

$this->title = Yii::t('app', 'Create Type Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Type Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'models' => $models,
]) ?>