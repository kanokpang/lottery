<?php

use kartik\switchinput\SwitchInput;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BankOwnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bank Owners');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Bank Owner'), ['/bank-owner/create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'bank-owner']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'accountName',
            'name',
            'number',
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'status',
                'filter' => [0 => Yii::t('app', 'Inactive'), 1 => Yii::t('app', 'Active')],
                'editableOptions' => [
                    'asPopover' => TRUE,
                    'formOptions' => [
                        'action' => ['/bank-owner/update-status'],
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
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/bank-owner/update', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default']);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/bank-owner/delete', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, ['class' => 'btn btn-default',
                            'data' => ['method' => 'post']]);
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>