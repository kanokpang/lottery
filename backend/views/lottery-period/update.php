<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lottery */

$this->title = Yii::t('app', 'Update Lottery: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
]) ?>