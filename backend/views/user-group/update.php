<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserGroup */

$this->title = Yii::t('app', 'Update User Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('_form', [
    'model' => $model,
    'listDataGroup' => $listDataGroup,
    'listDataUser' => $listDataUser,
]) ?>