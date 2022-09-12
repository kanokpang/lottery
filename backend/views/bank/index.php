<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banks');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Bank'), ['/bank/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'bank']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'filter' => [0 => Yii::t('app', 'Inactive'), 1 => Yii::t('app', 'Active')],
                'editableOptions' => [
                    'asPopover' => TRUE,
                    'formOptions' => [
                        'action' => ['update-status'],
                        'id' => 'wishitemaction'
                    ],
                    'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                    'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
                ],
                'hAlign' => 'center',
                'width' => '120px',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return $model->status == 0 ? '<span class="label label-danger">Inactive</span>' : '<span class="label label-success">Active</span>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons'=>[
                    'update' => function($url,$model,$key) {
                        $url = \yii\helpers\Url::to(['/bank/update', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default']);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
