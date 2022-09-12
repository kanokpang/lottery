<?php

use backend\models\BuyLottery;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bill Lotteries');
$this->params['breadcrumbs'][] = $this->title;
?>
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
                'total',
                [
                    'label' => Yii::t('app', 'Total Paid'),
                    'contentOptions' => ['class' => 'text-center'],
                    'options' => ['style' => 'text-align:center'],
                    'value' => function ($model) {
                        $idLotteried = explode(',', $model->idBuyLottery);
                        $buyLotteried = BuyLottery::find()->where(['id' => $idLotteried, 'isTrue' => 1])->all();
                        $total = 0;
                        if ($buyLotteried) {
                            foreach ($buyLotteried as $buyLottery) {
                                $total += $buyLottery->moneyPlay * $buyLottery->payment->payment;
                            }
                        }
                        return $buyLotteried ? $total : '-';

                    }
                ],
                //            'totalPaid',
                [
                    'label' => Yii::t('app', 'Status'),
                    'format' => 'html',
                    'value' => function ($model) {
                        $idLotteried = explode(',', $model->idBuyLottery);
                        $buyLotteried = BuyLottery::find()->select('isTrue')->where(['id' => $idLotteried])->groupBy('isTrue')->all();
                        $messageTrueOrFalse = '';
                        foreach ($buyLotteried as $buyLottery) {
                            if ($buyLottery->isTrue == 1) {
                                $messageTrueOrFalse .= '<span style="color: green">เล่นได้</span><br>';
                            } elseif ($buyLottery->isTrue == 2) {
                                $messageTrueOrFalse .= '<span style="color: red">เล่นเสีย</span><br>';
                            } else {
                                $messageTrueOrFalse .= '<span style="color: blue">รอผล</span><br>';
                            }
                        }
                        return $messageTrueOrFalse;
                    }
                ],
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
</div>
