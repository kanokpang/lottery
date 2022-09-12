<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Leaguefootball */

$this->title = Yii::t('app', 'Create League Football');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'League Footballs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
