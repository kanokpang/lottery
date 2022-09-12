<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_buy_football".
 *
 * @property int $id
 * @property int $matchId
 * @property int $teamWinByMatchId
 * @property int $createdBy
 * @property int $isTrue
 * @property int $type
 * @property string $createdAt
 * @property int $isFullTime
 *
 * @property User $createdBy0
 * @property Matchfootball $match
 */
class BuyFootball extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buy_football}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['matchId', 'teamWinByMatchId', 'moneyPlay', 'rate', 'isFullTime'], 'required'],
            [['matchId', 'teamWinByMatchId', 'createdBy', 'isTrue', 'isFullTime'], 'integer'],
            [['rate', 'type'], 'number'],
            [['moneyPlay'], 'validateMoneyWallet'],
            ['teamWinByMatchId', 'in', 'range' => [1, 2, 3]],
            ['type', 'in', 'range' => [1, 2, 3]],
            [['createdAt'], 'safe'],
            [['moneyPlay'], 'number', 'min' => 200],
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
        $scenario['answer'] = ['isTrue'];
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
            'moneyPlay' => Yii::t('app','Money Play'),
            'createdBy' => Yii::t('app','Created By'),
            'isTrue' => Yii::t('app','Is True'),
            'createdAt' => Yii::t('app','Created At'),
            'type' => Yii::t('app', 'Type'),
            'isFullTime' => Yii::t('app', 'Is Full Time'),
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

    public function getTeam()
    {
        return $this->hasOne(TeamFootball::className(), ['id' => 'teamWinByMatchId']);
    }

    public function validateMoneyWallet()
    {
        if ($this->moneyPlay > \common\models\User::findWallet(Yii::$app->user->id)) {
            return $this->addError('moneyPlay', Yii::t('app', 'The money in the account is not enough.'));
        }
    }
}
