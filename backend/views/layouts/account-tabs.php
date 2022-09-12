<?php

use yii\bootstrap\Tabs;
use yii\helpers\Url;

?>
<?=
Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('app', 'Bank'),
            'linkOptions'=> ['class' => 'bank'],
            'content' => $this->render('/bank/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Bank Owner'),
            'linkOptions'=> ['class' => 'bank-owner'],
            'content' => $this->render('/bank-owner/index', [
                'searchModel' => $bankOwnerSearch,
                'dataProvider' => $bankOwnerDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Manage Transfer Money'),
            'encode' => false,
            'linkOptions'=> ['class' => 'transfer'],
            'content' => $this->render('/transfer-money/index', [
                'searchModel' => $transferMoneySearch,
                'dataProvider' => $transferMoneyDataProvider,
                'permissionName' => $permissionName,
                'bankOwner' => $bankOwner,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Manage Withdraw'),
            'linkOptions'=> ['class' => 'withdraw'],
            'encode' => false,
            'content' => $this->render('/withdraw-money/index', [
                'searchModel' => $withdrawSearch,
                'dataProvider' => $withdrawDataProvider,
                'permissionName' => $permissionName,
                'bankOwner' => $bankOwner,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Transaction'),
            'linkOptions'=> ['class' => 'transaction'],
            'encode' => false,
            'content' => $this->render('/transaction-bank/index', [
                'searchModel' => $transactionSearch,
                'dataProvider' => $transactionDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Wallet'),
            'linkOptions'=> ['class' => 'wallet'],
            'encode' => false,
            'content' => $this->render('/wallet-user/index', [
                'searchModel' => $walletSearch,
                'dataProvider' => $walletDataProvider,
                'permissionName' => $permissionName,
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