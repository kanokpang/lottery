<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_promotion_lottery".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property PaymentLottery[] $paymentLotteries
 */
class PromotionLottery extends \yii\db\ActiveRecord
{
    const PROMOTION_SALE = 'โปรตัวแทนขาย';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%promotion_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' => Yii::t('app','Name'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentLotteries()
    {
        return $this->hasMany(PaymentLottery::className(), ['promotionLotteryId' => 'id']);
    }
}
