<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Lottery */

$this->title = Yii::t('app', 'Create Lottery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lotteries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'models' => $models,
]) ?>
