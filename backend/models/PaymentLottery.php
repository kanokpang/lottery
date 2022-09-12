<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_payment_lottery".
 *
 * @property int $id
 * @property int $typeLotterId
 * @property int $lotteryId
 * @property int $promotionLotteryId
 * @property string $payment
 * @property string $discount
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Lottery $lottery
 * @property TypeLottery $typeLotter
 */
class PaymentLottery extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeLotteryId', 'lotteryId', 'promotionLotteryId', 'payment', 'discount'], 'required'],
            [['typeLotteryId', 'lotteryId', 'promotionLotteryId'], 'unique',
                'targetAttribute' => ['typeLotteryId', 'lotteryId', 'promotionLotteryId'], 'message' => Yii::t('app','The combination of Type Lotter, Lottery and Promotion Lottery has already been taken.')],
            [['typeLotteryId', 'lotteryId', 'promotionLotteryId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['payment', 'discount'], 'number'],
            [['lotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['lotteryId' => 'id']],
            [['typeLotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => TypeLottery::className(), 'targetAttribute' => ['typeLotteryId' => 'id']],
            [['promotionLotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => PromotionLottery::className(), 'targetAttribute' => ['promotionLotteryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'typeLotteryId' => Yii::t('app',  'Type Lotter'),
            'lotteryId' => Yii::t('app', 'Lottery'),
            'promotionLotteryId' => Yii::t('app', 'Promotion Lottery'),
            'payment' => Yii::t('app', 'Payment'),
            'discount' => Yii::t('app', 'Discount'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'lotteryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeLottery()
    {
        return $this->hasOne(TypeLottery::className(), ['id' => 'typeLotteryId']);
    }

    public function getPromotionLottery()
    {
        return $this->hasOne(PromotionLottery::className(), ['id' => 'promotionLotteryId']);
    }
}
