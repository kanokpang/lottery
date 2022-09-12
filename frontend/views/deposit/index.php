<?php

use yii\bootstrap\Alert;
use  yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransferMoneySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transfer Moneys');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= $this->title ?></span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'transactionNumber',
                        [
                            'label' => Yii::t('app', 'Chanel Bank'),
                            'value' => 'chanelBank.name',
                        ],
                        [
                            'label' => Yii::t('app', 'Account Name'),
                            'value' => 'bankOwner.name',
                        ],
                        [
                            'label' => Yii::t('app', 'Number Bank'),
                            'value' => 'bankOwner.number',
                        ],
                        'money',
                        [
                            'attribute' => 'status',
                            'filter'=> ['0' => Yii::t('app', 'Pending'),
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
                        // 'transactionNumber',
                        // [
                        //     'label' => Yii::t('app', 'Chanel Bank'),
                        //     'value' => 'chanelBank.name',
                        // ],
                        'createdAt',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}</div>',
                            'buttonOptions' => ['class' => 'btn btn-default'],
                        ]
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>