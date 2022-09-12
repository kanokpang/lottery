<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootball */

$this->title = Yii::t('app', 'Update Match Football: {0}', $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_form', [
    'model' => $model,
    'listDataLeague' => $listDataLeague,
    'listDataTeam' => $listDataTeam,
    'teamId' => $teamId,
]) ?>