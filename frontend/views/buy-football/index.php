<?php

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Bill Football');
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
            <span class="caption-subject font-green-meadow bold uppercase"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div class="table-responsive">
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
                [
                    'label' => Yii::t('app', 'Full Time / First Time'),
                    'value' => function ($model) {
                        return $model->buy->isFullTime ?
                                Yii::t('app', 'Full Time') :
                                Yii::t('app', 'First Time');
                    },
                ],
                'createdAt',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}</div>',
                    'buttonOptions' => ['class' => 'btn btn-default'],
                ],
            ],
        ]); ?>
    </div>
</div>