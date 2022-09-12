<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_condition_lottery".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 * @property int $condition
 * @property string $limit
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $typeLotteryId
 * @property int $isPurchaseLimit
 */
class ConditionLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%condition_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lotteryId', 'number', 'typeLotteryId', 'limit', 'isPurchaseLimit'], 'required'],
            [['number', 'lotteryId', 'typeLotteryId'], 'unique', 'targetAttribute' => ['number', 'lotteryId', 'typeLotteryId']],
            [['number'], 'validateTypeLottery'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['typeLotteryId'], 'integer'],
            [['number'], 'number'],
            [['limit'], 'number', 'min' => 0],
            [['condition'], 'number', 'min' => 0, 'max' => 90],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function validateTypeLottery()
    {
        $typeLotteryName = $this->typeLottery->name;
        $numberTypeLottery = intval($typeLotteryName);
        if ($numberTypeLottery) {
            if ($numberTypeLottery !== strlen($this->number)) {
                $this->addError('number', 'Incorrect length number.');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name Condition'),
            'number' => Yii::t('app', 'Number'),
            'condition' => Yii::t('app', 'Condition'),
            'limit' => Yii::t('app', 'Limit'),
            'typeLotteryId' => Yii::t('app','Type Lottery'),
            'lotteryId' => Yii::t('app','Lottery Name'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'isPurchaseLimit' => Yii::t('app','Is Purchase'),
        ];
    }

    public function getLottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'lotteryId']);
    }

    public function getTypeLottery()
    {
        return $this->hasOne(TypeLottery::className(),['id' => 'typeLotteryId']);
    }
}
