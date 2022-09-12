<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootball */

$this->title = Yii::t('app', 'Create Match Football');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Match Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'listDataLeague' => $listDataLeague,
    'listDataTeam' => $listDataTeam,
    'teamId' => [],
]) ?>