<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = Yii::t('app', 'Update Group: {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
