<?php

use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TransactionBankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transaction Banks');
$this->params['breadcrumbs'][] = $this->title;
?>
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
                        [
                                'label' => Yii::t('app','Detail'),
                            'value' => 'triggerName'
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                if ($model->status === 0) {
                                    $status = Yii::t('app', 'Padding');
                                } elseif ($model->status === 1) {
                                    $status = Yii::t('app', 'Complete');
                                } elseif ($model->status === 2) {
                                    $status = Yii::t('app', 'Cancel');
                                }
                                return $status;
                            }
                        ],
                        'money',
                        'total',
                        'createdAt:dateTime',
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>