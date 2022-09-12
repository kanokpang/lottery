<?php

namespace backend\models;

use Faker\Provider\fr_FR\Payment;
use Yii;

/**
 * This is the model class for table "lol_buy_lottery".
 *
 * @property int $id
 * @property string $number
 * @property int $typeLotteryId
 * @property string $moneyPlay
 * @property string $moneyPay
 * @property int $paymentId
 * @property int $userId
 * @property int $isTrue
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $lotteryId
 *
 * @property BuyLottery $payment
 * @property BuyLottery[] $buyLotteries
 */
class BuyLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%buy_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'typeLotteryId', 'moneyPlay', 'moneyPay', 'paymentId', 'userId'], 'required'],
            [['typeLotteryId', 'paymentId', 'userId', 'isTrue', 'lotteryId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['number', 'moneyPlay', 'moneyPay'], 'number'],
            [['typeLotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => TypeLottery::className(), 'targetAttribute' => ['typeLotteryId' => 'id']],
            [['paymentId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentLottery::className(), 'targetAttribute' => ['paymentId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['lotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['lotteryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'number' => Yii::t('app','Number'),
            'typeLotteryId' => Yii::t('app','Type Name'),
            'moneyPlay' => Yii::t('app','Money Play'),
            'moneyPay' => Yii::t('app','Money Pay'),
            'paymentId' => Yii::t('app','Payment ID'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
            'isTrue' => Yii::t('app','is True'),
            'lotteryId' => Yii::t('app','Lottery'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getTypeLottery()
    {
        return $this->hasOne(TypeLottery::className(), ['id' => 'typeLotteryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentLottery::className(), ['id' => 'paymentId']);
    }

    public function getLottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'lotteryId']);
    }
}
