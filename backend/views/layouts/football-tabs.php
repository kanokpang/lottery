<?php

use yii\bootstrap\Tabs;
use yii\helpers\ArrayHelper;
?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= \yii\bootstrap\Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<?=
Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('app', 'Manage League'),
            'linkOptions' => ['class' => 'manage-league'],
            'content' => $this->render('/league-football/index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Manage Team'),
            'linkOptions' => ['class' => 'manage-team'],
            'content' => $this->render('/team-football/index', [
                'searchModel' => $teamFootballSearchModel,
                'dataProvider' => $teamFootballDataProvider,
                'listLeagueFootball' => $listLeagueFootball,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Manage Match'),
            'linkOptions' => ['class' => 'manage-match'],
            'content' => $this->render('/match-football/index', [
                'searchModel' => $manageMatchSearchModel,
                'dataProvider' => $manageMatchDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Bill Football'),
            'linkOptions' => ['class' => 'bill-football'],
            'content' => $this->render('/bill-football/index', [
                'searchModel' => $billFootballSearchModel,
                'dataProvider' => $billFootballDataProvider,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Buy Football'),
            'linkOptions' => ['class' => 'buy-football'],
            'content' => $this->render('/buy-football/index', [
                'searchModel' => $buyFootballSearchModel,
                'dataProvider' => $buyFootballDataProvider,
                'listLeagueFootball' => $listLeagueFootball,
                'listTeamFootball' => $listTeamFootball,
            ]),
        ],
        [
            'label' => Yii::t('app', 'Result Football'),
            'linkOptions' => ['class' => 'result-football'],
            'content' => $this->render('/result-football/index', [
                'searchModel' => $resultFootballSearch,
                'dataProvider' => $resultFootballDataProvider,
                'listTeamFootball' => $listTeamFootball,
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