<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BankOwner */

$this->title = Yii::t('app', 'Update Bank Owner: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bank Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<?= $this->render('_formUpdate', [
    'model' => $model,
]) ?>
