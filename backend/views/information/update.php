<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Information */

$this->title = Yii::t('app', 'Update Information: {0}', [$model->menu->name]);
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
    'listData' => $listData,
]) ?>
