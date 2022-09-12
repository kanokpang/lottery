<?php

use backend\models\NoteTransferMoney;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TransferMoney */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transfer Moneys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'bankOwner.name',
        'bankOwner.number',
        'money',
        [
            'attribute' => 'status',
            'value' => function ($model) {
                if ($model->status === 0) {
                    $textStatus = Yii::t('app', 'Pending');
                } elseif ($model->status === 1) {
                    $textStatus = Yii::t('app', 'Complete');
                } else {
                    $textStatus = Yii::t('app', 'Cancel');
                }
                return $textStatus;
            }
        ],
        'user.fullName',
        'transactionNumber',
        [
            'label' => Yii::t('app', 'Chanel Bank'),
            'value' => function ($model) {
                return $model->chanelBank->name;
            },
        ],
        'transactionDate',
        'createdAt',
        'updatedAt',
    ],
]) ?>
<?= $this->render('_formNote', [
    'model' => $model,
    'noteTransferMoney' => $noteTransferMoney
]) ?>
