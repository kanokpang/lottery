<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TeamFootball */

$this->title = Yii::t('app', 'Update Team Football: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Team Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_form', [
    'model' => $model,
    'listLeagueFootball' => $listLeagueFootball,
]) ?>