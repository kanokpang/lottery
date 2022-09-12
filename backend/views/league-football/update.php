<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Leaguefootball */

$this->title = Yii::t('app', 'Update League Football: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'League Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>