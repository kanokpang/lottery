<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WithdrawMoney */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Withdraw Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'bankName',
        'bankNumber',
        'money',
        [
            'attribute' => 'userId',
            'value' => function ($model) {
                return $model->status === 0 ? Yii::t('app', 'Pending') : Yii::t('app', 'Complete');
            }
        ],
        'user.fullName',
        'detail',
        'created.fullname',
        'transactionNumber',
        'createdAt',
        'updatedAt',
    ],
]) ?>