<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WithdrawMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Withdraw Moneys');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<h2><?= $this->title ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Withdraw Money'), ['/withdraw-money/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'withdraw-money']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'transactionNumber',
            [
                'attribute' => 'bankName',
                'value' => 'bankName',
            ],
            'bankNumber',
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
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{complete}{cancel}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'visibleButtons' => [
                    'update' => function ($model) use ($permissionName) {
                        return $model->status === 0 && Yii::$app->user->can($permissionName);
                    },
                    'complete' => function ($model) {
                        return $model->status === 0;
                    },
                    'cancel' => function ($model) {
                        return $model->status === 0;
                    }
                ],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/withdraw-money/view', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
                    },
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/withdraw-money/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'complete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/withdraw-money/complete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'disabled' => $model->status === 0 ? false : true,
                        ];
                        $title = $model->status === 0 ? Yii::t('app', 'Complete') : Yii::t('app', 'Pending');
                        return Html::a($title, $url, $options);
                    },
                    'cancel' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/withdraw-money/cancel', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'disabled' => $model->status === 0 ? false : true,
                        ];
                        return Html::a('<i class="glyphicon glyphicon-remove"></i>', $url, $options);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>