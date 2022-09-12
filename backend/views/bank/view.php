<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'code',
        'name',
        [
            'attribute' => 'status',
            'value' => function ($model) {
                return $model->status ? Yii::t('app', 'Active') : Yii::t('app', 'InActive');
            }
        ],
        'createdAt',
        'updatedAt',
    ],
]) ?>
