<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'format' => 'raw',
            'attribute' =>'profileImage',
            'value' => Html::img($model->getPhotoViewer(),['class'=>'img-thumbnail','style'=>'width:200px;']),
        ],
        'firstName',
        'lastName',
        'birthDate',
        'address',
        'username',
        'email:email',
        [
            'label' => Yii::t('app', 'Name Bank'),
            'value' => 'bank.name',
        ],
        'numberBank',
        [
            'label' => Yii::t('app', 'Is Enabled'),
            'value' => $model->enabled ? Yii::t('app', 'Enabled') : Yii::t('app', 'Un Enabled'),
        ],
        [
            'label' => Yii::t('app', 'Stauts'),
            'value' => $model->getItemStatusName(),
        ],
        'note',
        'lineId',
        'mobile',
        'referCode',
        'referenceReferCode',
        'createdAt',
        'updatedAt',
    ],
]) ?>
