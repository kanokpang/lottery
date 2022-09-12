<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

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
                        'bankName',
                        'bankNumber',
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
                        'createdAt',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>