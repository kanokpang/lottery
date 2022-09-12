<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/12/2018
 * Time: 4:16 PM
 */

use yii\grid\GridView;

?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Search FootBall') ?></span>
        </div>
    </div>
    <?= $this->render('_search', [
        'model' => $model,
        'listDataLeagueFootball' => $listDataLeagueFootball,
        'listDataTeamFootball' => $listDataTeamFootball
    ]); ?>
</div>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Result FootBall') ?></span>
        </div>
    </div>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => Yii::t('app', 'League Football'),
                    'value' => 'league.name',
                ],
                [
                    'label' => Yii::t('app', 'Match Team'),
                    'value' => function ($model) {
                        return $model->team1->name . '-' . $model->team2->name;
                    }
                ],
               [
                   'label' => Yii::t('app','Score'),
                   'value' => function ($model) {
                        return $model->scoreTeam1. '-' .$model->scoreTeam2;
                   }
               ],
               [
                   'label' => Yii::t('app','Start Match'),
                   'value' => function ($model) {
                       return $model->startMatch;
                   }
               ],
                [
                    'label' => Yii::t('app','End Match'),
                    'value' => function ($model) {
                        return $model->endMatch;
                    }
                ]
            ],
        ]); ?>
    </div>
</div>
