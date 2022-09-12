<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserGroup */

$this->title = Yii::t('app', 'Add User Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
    'listDataUser' => $listDataUser,
    'listDataGroup' => $listDataGroup,
]) ?>