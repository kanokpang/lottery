<?php

use backend\models\BuyLottery;
use backend\models\PromotionLottery;
use yii\bootstrap\Button;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BillLottery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bill Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Html::encode($this->title) ?></span>
        </div>
    </div>
    <div style="padding-top: 10px; padding-bottom: 15px;">
        <?php
        $now = date('Y-m-d');
        $endBuy = date_format(date_create($model->buy->match->endBuy), "Y-m-d");
        if ($endBuy > $now && $model->buy->isTrue === 0) {
            echo Button::widget([
                'label' => Yii::t('app', 'delete before date {0}', $endBuy),
                'options' => ['class' => 'btn-danger',
                    'href' => Url::to(["buy-football/delete", 'id' => $model->id]),
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete bill football?'),
                        'method' => 'post'
                    ]
                ],
            ]);
        }
        ?>
    </div>
    <div class="portlet box grey-cascade">
        <div class="portlet-title">
            <div class="caption">รายละเอียดบิลฟุตบอล</div>
        </div>
        <div class="portlet-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'label' => Yii::t('app', 'League'),
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
                        'label' => Yii::t('app', 'Team Buy'),
                        'value' => function ($model) {
                            return $model->buy->teamWinByMatchId === 1 ? $model->buy->match->team1->name : $model->buy->match->team2->name;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Total Play'),
                        'value' => function ($model) {
                            return $model->buy->moneyPlay;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Rate Play'),
                        'value' => function ($model) {
                            return $model->buy->rate;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Total'),
                        'value' => function ($model) {
                            return $model->buy->moneyPlay * $model->buy->rate;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Full Time / First Time'),
                        'value' => function ($model) {
                            return $model->buy->isFullTime ?
                                Yii::t('app', 'Full Time') :
                                Yii::t('app', 'First Time');
                        }
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
                ],
            ]) ?>
        </div>
    </div>
</div>