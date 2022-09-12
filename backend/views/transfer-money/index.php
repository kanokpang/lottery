<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transfer Moneys');
$this->params['breadcrumbs'][] = $this->title;
$listBankOwner = ArrayHelper::map($bankOwner, 'id','name');
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::T('app', 'Create Transfer Money'), ['/transfer-money/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'transfer-money']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'transactionNumber',
            [
                'attribute' => 'bankOwnerId',
                'filter' => $listBankOwner,
                'options' => ['style' => 'width:160px;'],
                'label' => Yii::t('app', 'Account'),
                'value' => 'bankOwner.name',
            ],
            [
                'label' => Yii::t('app', 'Number Bank'),
                'value' => 'bankOwner.number',
            ],
            'money',
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
            //'transactionNumber',
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
//                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{complete}{cancel}</div>',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'visibleButtons' => [
                    'update' => function ($model) use ($permissionName) {
                        return $model->status === 0 && Yii::$app->user->can($permissionName);
                    },
//                    'complete' => function ($model) {
//                        return $model->status === 0;
//                    },
//                    'cancel' => function ($model) {
//                        return $model->status === 0;
//                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/transfer-money/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/transfer-money/view', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
                    },
//                    'complete' => function ($url, $model, $key) {
//                        $options = [
//                            'class' => 'btn btn-default',
//                            'disabled' => $model->status === 0 ? false : true,
//                        ];
//                        $title = $model->status === 0 ? Yii::t('app', 'Complete') : Yii::t('app', 'Pending');
//                        return Html::a($title, $url, $options);
//                    },
//                    'cancel' => function ($url, $model, $key) {
//                        $options = [
//                            'class' => 'btn btn-default',
//                            'disabled' => $model->status === 0 ? false : true,
//                        ];
//                        return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, $options);
//                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>