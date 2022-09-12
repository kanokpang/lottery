<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WinLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Win Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(Yii::t('app', 'Create Win Lottery'), ['/lottery-result/create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app', 'Create Lottery First Prize'), ['/lottery-result/create-lottery'], ['class' => 'btn btn-danger']) ?>
</p>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'win-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => Yii::t('app', 'Lottery'),
                'filter' => \kartik\select2\Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'lotteryId',
                    'data' => ArrayHelper::map(\backend\models\Lottery::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => Yii::t('app', 'Select a lottery')],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
                'value' => 'lottery.name',
            ],
            'typeLottery.name',
            'number',
            'createdAt',
            'updatedAt',
            [
                'attribute' => 'answer',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->answer === 0 ? '<span style="color: red">' . Yii::t('app', 'Not Answer') . '</span>'
                        : '<span style="color:blue">' . Yii::t('app', 'Answer') . '</span>';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{update}{delete}{answer}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->answer === 0;
                    },
                    'delete' => function ($model) {
                        return $model->answer === 0;
                    },
                    'answer' => function ($model) {
                        return $model->answer === 0;
                    }
                ],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/lottery-result/update', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/lottery-result/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => ['method' => 'post'],
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
                    'answer' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/lottery-result/answer', 'id' => $model->id]);
                        return Html::a(Yii::t('app', 'Answer'), $url, ['class' => 'btn btn-default']);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
