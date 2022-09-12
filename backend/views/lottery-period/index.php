<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Lottery'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="table-responsive">
    <?php Pjax::begin(['id' => 'lottery-period']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'startDateTime',
            'endDateTime',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>