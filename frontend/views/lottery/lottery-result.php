<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lottery Result');
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

                'number',
                'typeLottery.name',
                'moneyPlay',
                'moneyPay',
                'payment.promotionLottery.name',
                'createdAt',
                [
                    'attribute' => 'isTrue',
                    'format' => 'html',
                    'value' => function ($model) {
                        if ($model->isTrue === 1) {
                            $icon = 'glyphicon glyphicon-ok';
                        } elseif ($model->isTrue === 2) {
                            $icon = 'glyphicon glyphicon-remove';
                        } else {
                            $text = '<span style="color: blue">รอผล</span>';
                        }
                        return isset($text) ? $text : '<span class="' . $icon . '" aria-hidden="true">';
                    }
                ],
            ],
        ]); ?>
    </div>
</div>
</div>
</div>