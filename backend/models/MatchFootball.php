<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_matchfootball".
 *
 * @property int $id
 * @property int $leagueId
 * @property int $teamId1
 * @property int $teamId2
 * @property string $scoreTeam1
 * @property string $scoreTeam2
 * @property string $detail
 * @property int $status
 * @property string $startMatch
 * @property string $endMatch
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $hdpFirstTime
 * @property string $homeFirstTime
 * @property string $awayFirstTime
 * @property string $goalFirstTime
 * @property string $overFirstTime
 * @property string $underFirstTime
 * @property string $hdpFullTime
 * @property string $homeFullTime
 * @property string $awayFullTime
 * @property string $goalFullTime
 * @property string $overFullTime
 * @property string $underFullTime
 * @property int $isFullTime
 * @property string $startBuy
 * @property string $endBuy
 * @property string $rangeOverFirstTime
 * @property string $rangeOverFullTime
 * @property float  $homeWinFirstTime
 * @property float  $awayWinFirstTime
 * @property float  $drawWinFirstTime
 * @property float  $homeWinFullTime
 * @property float  $awayWinFullTime
 * @property float  $drawWinFullTime
 *
 * @property Leaguefootball $league
 * @property Leaguefootball $team1
 * @property Leaguefootball $team2
 */
class MatchFootball extends ActiveRecord
{
    public $team;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%matchfootball}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leagueId', 'teamId1', 'teamId2', 'startMatch', 'endMatch', 'hdpFirstTime', 'homeFirstTime',
                'awayFirstTime', 'goalFirstTime', 'overFirstTime', 'underFirstTime', 'startBuy', 'endBuy',
                'isSecondTeam', 'homeWinFirstTime', 'awayWinFirstTime', 'drawWinFirstTime',
                'homeWinFullTime', 'awayWinFullTime', 'drawWinFullTime'], 'required'],
            [['hdpFullTime', 'homeFullTime', 'awayFullTime', 'goalFullTime', 'overFullTime', 'underFullTime'],
                'required', 'when' => function ($model) {
                return $model->isFullTime === 1;
            }, 'whenClient' => "function (attribute, value) {
                 var selected = $(\"input[type='radio'][name='MatchFootball[isFullTime]']:checked\");
                if (selected.length > 0) {
                    return parseInt(selected.val()) === 1
                }
            }"],
            [['isSecondTeam'], 'integer'],
            [['startMatch'], 'validateDateMatch'],
            [['startBuy'], 'validateDateBuy'],
            [['endMatch'], 'validateEndCurrentNow', 'on' => 'score'],
            [['startMatch', 'endMatch', 'startBuy', 'endBuy'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['leagueId', 'teamId1', 'teamId2', 'status', 'isFullTime'], 'integer'],
            [['detail', 'goalFirstTime', 'goalFullTime', 'rangeOverFirstTime', 'rangeOverFullTime'], 'string'],
            [['startMatch', 'endMatch', 'createdAt', 'updatedAt'], 'safe'],
            [['scoreTeam1', 'scoreTeam2', 'hdpFirstTime', 'homeFirstTime',
                'awayFirstTime',  'overFirstTime', 'underFirstTime', 'hdpFullTime', 'homeFullTime',
                'awayFullTime', 'overFullTime', 'underFullTime', 'homeWinFirstTime', 'awayWinFirstTime', 'drawWinFirstTime',
                'homeWinFullTime', 'awayWinFullTime', 'drawWinFullTime'], 'number'],
            [['scoreTeam1', 'scoreTeam2'], 'default', 'value' => 0],
            [['leagueId'], 'exist', 'skipOnError' => true, 'targetClass' => Leaguefootball::className(), 'targetAttribute' => ['leagueId' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['score'] = array_merge($scenario['default'],['scoreTeam2', 'scoreTeam1']);
        return $scenario;
    }

    public function validateEndCurrentNow()
    {
        $now = date("Y-m-d H:i:s");
        if ($this->endMatch >= $now) {
            $items = [
                'scoreTeam1' => Yii::t('app', 'I did not finish the race.'),
                'scoreTeam2' => Yii::t('app', 'I did not finish the race.')
            ];
            $this->addErrors($items);
        }
    }

    public function validateDateMatch()
    {
        if ($this->endMatch <= $this->startMatch) {
            $this->addError('startMatch', 'Please give correct Start and End dates');
            $this->addError('endMatch', 'Please give correct Start and End dates');
        }
    }

    public function validateDateBuy()
    {
        if ($this->endBuy <= $this->startBuy) {
            $this->addError('startBuy', 'Please give correct Start and End dates');
            $this->addError('endBuy', 'Please give correct Start and End dates');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'leagueId' => Yii::t('app', 'League Name'),
            'teamId1' => Yii::t('app', 'Team Home'),
            'teamId2' => Yii::t('app', 'Team Away'),
            'scoreTeam1' => Yii::t('app', 'Score Team1'),
            'scoreTeam2' => Yii::t('app', 'Score Team2'),
            'detail' => Yii::t('app', 'Detail'),
            'status' => Yii::t('app', 'Status'),
            'startMatch' => Yii::t('app', 'Start Match'),
            'endMatch' => Yii::t('app', 'End Match'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'hdpFirstTime' => Yii::t('app', 'HDP First Time'),
            'homeFirstTime' => Yii::t('app', 'Home First Time'),
            'awayFirstTime' => Yii::t('app', 'Away First Time'),
            'goalFirstTime' => Yii::t('app', 'Goal First Time'),
            'overFirstTime' => Yii::t('app', 'Over First Time'),
            'underFirstTime' => Yii::t('app', 'Under First Time'),
            'hdpFullTime' => Yii::t('app', 'HDP First Time'),
            'homeFullTime' => Yii::t('app', 'Home Full Time'),
            'awayFullTime' => Yii::t('app', 'Away Full Time'),
            'goalFullTime' => Yii::t('app', 'Goal Full Time'),
            'overFullTime' => Yii::t('app', 'Over Full Time'),
            'underFullTime' => Yii::t('app', 'Under Full Time'),
            'isFullTime' => Yii::t('app', 'Is Full Time'),
            'startBuy' => Yii::t('app','Start Buy'),
            'endBuy' => Yii::t('app','End Buy'),
			'isSecondTeam' => Yii::t('app', 'Is Team Handicap'),
            'rangeOverFirstTime' => Yii::t('app', 'Range Over First Time'),
            'rangeOverFullTime' => Yii::t('app', 'Range Over Full Time'),
            'homeFirstTimeWin' => Yii::t('app', 'Home First Time Win'),
            'awayFirstTimeWin' => Yii::t('app', 'Away First Time Win'),
            'drawFirstTimeWin' => Yii::t('app', 'Draw First Time Win'),
            'homeFullTimeWin' => Yii::t('app', 'Home Full Time Win'),
            'awayFullTimeWin' => Yii::t('app', 'Away Full Time Win'),
            'drawFullTimeWin' => Yii::t('app', 'Draw Full Time Win'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeague()
    {
        return $this->hasOne(Leaguefootball::className(), ['id' => 'leagueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam1()
    {
        return $this->hasOne(TeamFootball::className(), ['id' => 'teamId1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam2()
    {
        return $this->hasOne(TeamFootball::className(), ['id' => 'teamId2']);
    }
}
