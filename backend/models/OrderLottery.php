<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_order_lottery".
 *
 * @property int $id
 * @property string $number
 * @property string $moneyPlay
 * @property double $moneyPay
 * @property int $paymentId
 * @property int $userId
 * @property int $typeLotteryId
 * @property int $OrderlotteryId
 * @property int $isExistBuy
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property TypeLottery $typeLottery
 * @property PaymentLottery $payment
 * @property User $user
 * @property LotteryPeriod $orderlottery
 */
class

OrderLottery extends \yii\db\ActiveRecord
{
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'moneyPlay', 'moneyPay', 'paymentId', 'typeLotteryId', 'OrderlotteryId'], 'required'],
            [['number'], 'validateFixNumberByTypeLottery'],
            [['number'], 'validateNumberByConditionLottery', 'on' => 'order'],
            [['moneyPay','moneyPlay', 'number'], 'number'],
            ['moneyPlay', 'compare', 'compareValue' => 10, 'operator' => '>=', 'type' => 'number'],
            [['moneyPlay'], 'validateMoneyWallet', 'on' => 'order'],
            [['paymentId', 'userId', 'typeLotteryId', 'OrderlotteryId', 'isExistBuy'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['typeLotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => TypeLottery::className(), 'targetAttribute' => ['typeLotteryId' => 'id']],
            [['paymentId'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentLottery::className(), 'targetAttribute' => ['paymentId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['OrderlotteryId'], 'exist', 'skipOnError' => true, 'targetClass' => Lottery::className(), 'targetAttribute' => ['OrderlotteryId' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['order'] = array_merge($scenario['default'], ['order']);
        return $scenario;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'number' => Yii::t('app','Number'),
            'moneyPlay' => Yii::t('app','Money Play'),
            'moneyPay' => Yii::t('app','Money Pay'),
            'paymentId' => Yii::t('app','Payment'),
            'userId' => Yii::t('app','User'),
            'typeLotteryId' => Yii::t('app','Type Lottery'),
            'OrderlotteryId' => Yii::t('app','Lottery'),
            'isExistBuy' => Yii::t('app','Exist Buy'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
        ];
    }

    public function validateMoneyWallet()
    {
        $money = OrderLottery::find()->select(['SUM(moneyPay) as moneyPay'])->where(['userId' => Yii::$app->user->id, 'OrderlotteryId' => $this->orderlottery, 'isExistBuy' => 0])->one();
        $moneyPay = $money->moneyPay;
        $moneyPay += intval($this->moneyPay);
        if ($moneyPay > \common\models\User::findWallet(Yii::$app->user->id)) {
            return $this->addError('moneyPlay',Yii::t('app', 'The money in the account is not enough.'));
        }
    }

    public function validateNumberByConditionLottery()
    {
        $conditionLottery = ConditionLottery::find()->where(['lotteryId' => $this->OrderlotteryId, 'number' => $this->number, 'typeLotteryId' => $this->typeLotteryId])->one();
        if ($conditionLottery) {
            $conditionLimit = $conditionLottery->limit;
            $orderLottery = OrderLottery::find()->where(['OrderlotteryId' => $this->OrderlotteryId, 'number' => $this->number, 'typeLotteryId' => $this->typeLotteryId])->count();
            if ($orderLottery >= $conditionLimit) {
                $messageError = $conditionLottery->isPurchaseLimit ? Yii::t('app', 'This number can not be purchased') :
                    Yii::t('app','This number not for sale');
                return $this->addError('number', $messageError);
            }
        }
    }

    public function validateFixNumberByTypeLottery()
    {
        $typeLottery = TypeLottery::findOne(['id' => $this->typeLotteryId]);
        $maxLength = filter_var($typeLottery->name, FILTER_SANITIZE_NUMBER_INT);
        $length = $this->number;
        if (strlen($length) != $maxLength) {
            return $this->addError('number', Yii::t('app', 'The number must be equal {0}', $maxLength));
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderlottery()
    {
        return $this->hasOne(Lottery::className(), ['id' => 'OrderlotteryId']);
    }
}
