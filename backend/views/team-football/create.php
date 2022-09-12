<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TeamFootball */

$this->title = Yii::t('app', 'Create Team Football');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Team Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'listLeagueFootball' => $listLeagueFootball,
]) ?>