<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_lottery".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property PaymentLottery[] $paymentLotteries
 */
class Lottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lottery_period}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'startDateTime', 'endDateTime'], 'required'],
            [['startDateTime', 'endDateTime'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['startDateTime','validateDates'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'startDateTime' => Yii::t('app', 'Start Date Time'),
            'endDateTime' => Yii::t('app', 'End Date Time'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    public function validateDates()
    {
        if ($this->endDateTime <= $this->startDateTime) {
            $this->addError('startDateTime', 'Please give correct Start and End dates');
            $this->addError('endDateTime', 'Please give correct Start and End dates');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentLotteries()
    {
        return $this->hasMany(PaymentLottery::className(), ['lotteryId' => 'id']);
    }
}
