<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Information */

$this->title = Yii::t('app', 'Create Information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Informations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'listData' => $listData,
]) ?>