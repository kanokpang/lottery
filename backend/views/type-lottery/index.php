<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Type Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Type Lottery'), ['/type-lottery/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'type-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'createdAt',
            'updatedAt',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'filter' => [0 => Yii::t('app', 'Un Enabled'), 1 => Yii::t('app', 'Enabled')],
                'editableOptions' => [
                    'asPopover' => TRUE,
                    'formOptions' => [
                        'action' => ['/type-lottery/update-status'],
                        'id' => 'wishitemaction'
                    ],
                    'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                    'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
                ],
                'hAlign' => 'center',
                'width' => '120px',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return $model->status == 0 ? '<span class="label label-danger">'.Yii::t('app','Un Enabled').'</span>'
                    : '<span class="label label-success">'.Yii::t('app','Enabled').'</span>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/type-lottery/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/type-lottery/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => ['method' => 'post'],
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>