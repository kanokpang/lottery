<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = Yii::t('app', 'Create Bank');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'models' => $models,
]) ?>
