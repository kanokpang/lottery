<?php

use yii\bootstrap\Tabs;

?>
<?=
Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('app', 'Lottery Period'),
            'linkOptions' => ['class' => 'lottery-period'],
            'content' => $this->render('/lottery-period/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Promotion Lottery'),
            'linkOptions' => ['class' => 'lottery-promotion'],
            'content' => $this->render('/promotion-lottery/index', [
                'searchModel' => $promotionLotterySearchModel,
                'dataProvider' => $promotionLotteryDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Type Lottery'),
            'linkOptions' => ['class' => 'type-lottery'],
            'content' => $this->render('/type-lottery/index', [
                'searchModel' => $typeLotterySearchModel,
                'dataProvider' => $typeLotteryDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Payment Lottery'),
            'linkOptions' => ['class' => 'payment-lottery'],
            'content' => $this->render('/payment-lottery/index', [
                'searchModel' => $paymentLotterySearchModel,
                'dataProvider' => $paymentLotteryDataProvider,
                'listTypeLottery' => $listTypeLottery
            ]),
        ],
        [
            'label' => Yii::t('app', 'Condition Lottery'),
            'linkOptions' => ['class' => 'condition-lottery'],
            'content' => $this->render('/condition-lottery/index', [
                'searchModel' => $conditionLotterySearchModel,
                'dataProvider' => $conditionLotteryDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Buy Lottery'),
            'linkOptions' => ['class' => 'buy-lottery'],
            'content' => $this->render('/buy-lottery/index', [
                'searchModel' => $buyLotterySearchModel,
                'dataProvider' => $buyLotteryDataProvider,
                'listTypeLottery' => $listTypeLottery,
                'listPromotionLottery' => $listPromotionLottery,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Lottery Results'),
            'linkOptions' => ['class' => 'lottery-result'],
            'content' => $this->render('/lottery-result/index', [
                'searchModel' => $winLotterySearchModel,
                'dataProvider' => $winLotteryDataProvider,
            ]),
        ],
    ],
]);

$js = <<<EOT
var get = GetURLParameter('id');
if (typeof get != 'undefined') {
    $('.'+get).tab('show');
}

function GetURLParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) 
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) 
        {
            return sParameterName[1];
        }
    }
}
EOT;
$this->registerJs($js);
?>