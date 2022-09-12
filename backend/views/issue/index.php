<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IssueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Issues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issue-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'description:html',
            'user.fullName',
            'createdAt',
            [
                'attribute' => 'status',
                'filter' => [0 => Yii::t('app', 'Close'), 1 => Yii::t('app', 'Open')],
                'value' => function ($model) {
                    return $model->status ? Yii::t('app', 'Open') : Yii::t('app', 'Close');
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view},{close}</div>',
                'buttons' => [
                    'close' => function ($url, $model) {
                        $url = ['issue/delete', 'id' => $model->id];
                        return Html::a($model->status ? '<span class="glyphicon glyphicon-remove"></span>' : '<span class="fa fa-undo"></span>', $url, [
                            'class' => 'btn btn-default',
                            'data' => ['method' => 'post']]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
