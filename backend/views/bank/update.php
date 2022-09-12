<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = Yii::t('app', 'Update Bank: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
]) ?>
