<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/12/2018
 * Time: 4:16 PM
 */

use yii\bootstrap\Alert;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="col-md-6">
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
</div>
<div class="col-md-6">
    <div class="portlet light ">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="fa fa-newspaper-o font-green-meadow"></i>
                <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'List Buy') ?></span>
            </div>
        </div>
        <?= $this->render('_buy', [
            'model' => $buyFootball,
            'teamId' => $teamId,
            'selectedTeam' => $selectedTeam,
            'rate' => $rate,
            'type' => $type,
        ]); ?>
    </div>
</div>
<div class="col-md-12">
    <div class="portlet light ">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="fa fa-newspaper-o font-green-meadow"></i>
                <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'FootBall') ?></span>
            </div>
        </div>
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => Yii::t('app', 'Date Match'),
                        'value' => 'startMatch',
                    ],
                    [
                        'label' => Yii::t('app', 'Match Team'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $isSecondTeam = $model->isSecondTeam;
                            $team1 = $isSecondTeam === 1 ? '<span style="color: red;">'. $model->team1->name. '</span>' : $model->team1->name;
                            $logo1 = Html::img([
                                '/../../' . Yii::$app->urlManagerBackend->baseUrl . '/team-football/' . $model->team1->logo
                            ], [
                                'width' => '30',
                                'height' => '30',
                                'align' => 'right',
                            ]);
                            $team2 = $isSecondTeam === 2 ? '<span style="color: red;">'. $model->team2->name. '</span>' : $model->team2->name;
                            $logo2 = Html::img([
                                '/../../' . Yii::$app->urlManagerBackend->baseUrl . '/team-football/' . $model->team2->logo
                            ], [
                                'width' => '30',
                                'height' => '30',
                                'align' => 'right',
                                'padding' => '10',
                            ]);
                            return $team1 . $logo1 . '<br><br>' . $team2 . $logo2;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'HDP FullTime'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFullTimeHome = Html::a($model->homeFullTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 2, 'type' => 1]);
                            $textHdpHome =  '<span style="float: right;">' . $urlFullTimeHome .'</span>';
                            $urlFullTimeAway = Html::a($model->awayFullTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 2, 'type' => 1]);
                            $textHdpAway = '<span style="float: right;">' . $urlFullTimeAway .'</span>';
                            $textHdpHome = $model->isSecondTeam === 1 ? '<span style="float: left;">' . $model->hdpFullTime . '</span>'.$textHdpHome : $textHdpHome;
                            $textHdpAway = $model->isSecondTeam === 2 ? '<span style="float: left;">' . $model->hdpFullTime . '</span>'.$textHdpAway : $textHdpAway;
                            return $textHdpHome . '<br>' . $textHdpAway;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Over FullTime'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFullTimeHome = Html::a($model->overFullTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 2, 'type' => 2]);
                            $urlFullTimeAway = Html::a($model->underFullTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 2, 'type' => 2]);
                            $textOverHome =  '<span style="float: left;">' . $model->rangeOverFullTime . '</span><span style="float: right;">' . $urlFullTimeHome .'</span>';
                            $textOverAway =  '<span style="float: left;">U</span><span style="float: right;">' . $urlFullTimeAway .'</span>';
                            return $textOverHome . '<br>' . $textOverAway;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'HxA'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFullTimeHome = Html::a($model->homeWinFullTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 2, 'type' => 3]);
                            $urlFullTimeAway = Html::a($model->awayWinFullTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 2, 'type' => 3]);
                            $urlFullTimeDraw = Html::a($model->drawWinFullTime, ['football/index', 'id' => $model->id, 'teamId' => 3, 'rate' => 2, 'type' => 3]);
                            return $urlFullTimeHome . '<br>' . $urlFullTimeAway . '<br>' . $urlFullTimeDraw;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'HDP FirstTime'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFirstTimeHome = Html::a($model->homeFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 1, 'type' => 1]);
                            $textHdpHome =  '<span style="float: left;">' . $model->hdpFirstTime . '</span><span style="float: right;">' . $urlFirstTimeHome .'</span>';
                            $urlFirstTimeAway = Html::a($model->awayFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 1, 'type' => 1]);
                            $textHdpAway = '<span style="float: right;">' . $urlFirstTimeAway .'</span>';
                            return $textHdpHome . '<br>' . $textHdpAway;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'Over FirstTime'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFirstTimeHome = Html::a($model->overFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 1, 'type' => 2]);
                            $urlFirstTimeAway = Html::a($model->underFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 1, 'type' => 2]);
                            $textOverHome =  '<span style="float: left;">' . $model->rangeOverFirstTime . '</span><span style="float: right;">' . $urlFirstTimeHome .'</span>';
                            $textOverAway =  '<span style="float: left;">U</span><span style="float: right;">' . $urlFirstTimeAway .'</span>';
                            return $textOverHome . '<br>' . $textOverAway;
                        }
                    ],
                    [
                        'label' => Yii::t('app', 'HxA'),
                        'format' => 'html',
                        'value' => function ($model) {
                            $urlFirstTimeHome = Html::a($model->homeWinFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 1, 'rate' => 1, 'type' => 3]);
                            $urlFirstTimeAway = Html::a($model->awayWinFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 2, 'rate' => 1, 'type' => 3]);
                            $urlFirstTimeDraw = Html::a($model->drawWinFirstTime, ['football/index', 'id' => $model->id, 'teamId' => 3, 'rate' => 1, 'type' => 3]);
                            return $urlFirstTimeHome . '<br>' . $urlFirstTimeAway . '<br>' . $urlFirstTimeDraw;
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
