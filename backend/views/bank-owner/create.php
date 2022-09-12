<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BankOwner */

$this->title = Yii::t('app', 'Create Bank Owner');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bank Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'models' => $models,
]) ?>