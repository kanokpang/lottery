<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill Lotteries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-lottery-index">
    <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <?= \yii\bootstrap\Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ]) ?>
    <?php endif; ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app', 'Bill Number'),
                'attribute' => 'name',
                'value' => 'name'
            ],
            'total',
            'createdAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{print}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'buttons' => [
                    'print' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-print"></i>', $url, ['class' => 'btn btn-default', 'target' => '_blank']);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
