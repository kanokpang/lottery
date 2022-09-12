<?php
use yii\grid\GridView;
use yii\widgets\Pjax;

?>
<div class="table-responsive">
    <?php Pjax::begin(['id' => 'buy-lottery']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app', 'League Name'),
                'attribute' => 'leagueId',
                'filter' => $listLeagueFootball,
                'value' => function ($model) {
                    return $model->match->league->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Match Name'),
                'attribute' => 'teamId',
                'filter' => $listTeamFootball,
                'value' => function ($model) {
                    return $model->match->team1->name . '-' . $model->match->team2->name;
                }
            ],
            [
                'label' => Yii::t('app', 'Team Buy'),
                'attribute' => 'teamWinByMatchId',
                'filter' => $listTeamFootball,
                'value' => function ($model) {
                    return $model->teamWinByMatchId === 1 ? $model->match->team1->name : $model->match->team2->name;
                }
            ],
            'moneyPlay',
            'rate',
            [
                'label' => Yii::t('app', 'Type Buy Match'),
                'attribute' => 'type',
                'filter' => [1 => Yii::t('app', 'HDP'), 2 => Yii::t('app', 'Over'), 3 => Yii::t('app', 'HxA')],
                'value' => function ($model) {
                    if ($model->type === 1) {
                        $typeMatch = 'HDP';
                    } elseif ($model->type === 2) {
                        $typeMatch = 'OVER';
                    } else {
                        $typeMatch = 'HxA';
                    }
                    return $typeMatch;
                }
            ],
            [
                'label' => Yii::t('app', 'Full Time / First Time'),
                'value' => function ($model) {
                    return $model->isFullTime ?
                        Yii::t('app', 'Full Time') :
                        Yii::t('app', 'First Time');
                },
            ],
            [
                'label' => Yii::t('app', 'Status'),
                'format' => 'html',
                'value' => function ($model) {
                    $messageTrueOrFalse = '';
                    if ($model->isTrue == 1) {
                        $messageTrueOrFalse .= '<span style="color: green">เล่นได้</span><br>';
                    } elseif ($model->isTrue == 2) {
                        $messageTrueOrFalse .= '<span style="color: red">เล่นเสีย</span><br>';
                    } else {
                        $messageTrueOrFalse .= '<span style="color: blue">รอผล</span><br>';
                    }
                    return $messageTrueOrFalse;
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
