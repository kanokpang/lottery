<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transaction Banks');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'transaction-bank']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'bankName',
                'label' => Yii::t('app', 'Account'),
                'value' => 'bankName',
            ],
            [
                'attribute' => 'bankNumber',
                'label' => Yii::t('app', 'Number Bank'),
                'value' => 'bankNumber',
            ],
            [
                'attribute' => 'total',
                'format' => ['decimal', 2]
            ],
            [
                'attribute' => 'status',
                'filter' => ['0' => Yii::t('app', 'Pending'),
                    '1' => Yii::t('app', 'Complete'),
                    '2' => Yii::t('app', 'Cancel')
                ],
                'value' => function ($model) {
                    if ($model->status === 0) {
                        $status = Yii::t('app', 'Pending');
                    } elseif ($model->status === 1) {
                        $status = Yii::t('app', 'Complete');
                    } elseif ($model->status === 2) {
                        $status = Yii::t('app', 'Cancel');
                    }
                    return $status;
                }
            ],
            'user.fullName',
            'triggerName',
            'createdAt:dateTime',
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>