<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lol_result_football".
 *
 * @property int $id
 * @property int $matchId
 * @property int $teamWinByMatchId
 * @property int $createdBy
 * @property string $createdAt
 * @property int $type
 * @property int $isFullTime
 * @property int $isAnswer
 *
 * @property User $createdBy0
 * @property Matchfootball $match
 */
class ResultFootball extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%result_football}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matchId', 'teamWinByMatchId', 'isFullTime', 'type'], 'required'],
            [['matchId', 'teamWinByMatchId', 'createdBy', 'isFullTime', 'isAnswer'], 'integer'],
            [['createdAt'], 'safe'],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
            [['matchId'], 'exist', 'skipOnError' => true, 'targetClass' => Matchfootball::className(), 'targetAttribute' => ['matchId' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false,
            ],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['answer'] = ['isAnswer'];
        return $scenario;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'matchId' => Yii::t('app','Match'),
            'teamWinByMatchId' => Yii::t('app','Team Win By Match ID'),
            'createdBy' => Yii::t('app','Created By'),
            'createdAt' => Yii::t('app','Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Matchfootball::className(), ['id' => 'matchId']);
    }

    public function getTeamWin()
    {
        return $this->hasOne(TeamFootball::className(), ['id' => 'teamWinByMatchId']);
    }
}
