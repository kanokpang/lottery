<?php

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'bill-football']) ?>
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
            [
                'label' => Yii::t('app', 'Total Play'),
                'value' => function ($model) {
                    return $model->buy->moneyPlay;
                }
            ],
            [
                'label' => Yii::t('app', 'League Name'),
                'value' => function ($model) {
                    return $model->buy->match->league->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Match Name'),
                'value' => function ($model) {
                    return $model->buy->match->team1->name . '-' . $model->buy->match->team2->name;
                },
            ],
            [
                'label' => Yii::t('app', 'Full Time / First Time'),
                'value' => function ($model) {
                    return $model->buy->isFullTime ?
                        Yii::t('app', 'Full Time') :
                        Yii::t('app', 'First Time');
                },
            ],
            [
                'label' => Yii::t('app', 'Status'),
                'format' => 'html',
                'value' => function ($model) {
                    $messageTrueOrFalse = '';
                    if ($model->buy->isTrue == 1) {
                        $messageTrueOrFalse .= '<span style="color: green">เล่นได้</span><br>';
                    } elseif ($model->buy->isTrue == 2) {
                        $messageTrueOrFalse .= '<span style="color: red">เล่นเสีย</span><br>';
                    } else {
                        $messageTrueOrFalse .= '<span style="color: blue">รอผล</span><br>';
                    }
                    return $messageTrueOrFalse;
                }
            ],
            'createdAt',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'visibleButtons' => [
                    'delete' => function ($model) {
                        $now = date('Y-m-d');
                        $endBuy = date_format(date_create($model->buy->match->endBuy), "Y-m-d");
                        if ($endBuy > $now && $model->buy->isTrue === 0) {
                            return true;
                        }
                        return false;
                    }
                ],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/bill-football/view', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                        ];
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/bill-football/delete', 'id' => $model->id]);
                        $options = [
                            'class' => 'btn btn-default',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete bill football?'),
                                'method' => 'post'
                            ]
                        ];
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
