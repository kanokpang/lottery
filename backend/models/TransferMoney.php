<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_transfer_money".
 *
 * @property int $id
 * @property int $bankOwnerId
 * @property double $money
 * @property int $status
 * @property int $userId
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $transactionNumber
 *
 * @property BankOwner $bankOwner
 * @property User $user
 */
class TransferMoney extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transfer_money}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' =>false,
                'updatedByAttribute' => 'updatedBy',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankOwnerId', 'money', 'transactionNumber', 'chanelBankId', 'userId', 'transactionDate'], 'required'],
            [['status'], 'default', 'value' => 0],
            [['bankOwnerId', 'status', 'userId', 'updatedBy'], 'integer'],
            [['transactionDate'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['money'], 'number', 'min' => '200'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['bankOwnerId'], 'exist', 'skipOnError' => true, 'targetClass' => BankOwner::className(), 'targetAttribute' => ['bankOwnerId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
            [['chanelBankId'], 'exist', 'skipOnError' => true, 'targetClass' => ChanelBank::className(), 'targetAttribute' => ['chanelBankId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'bankOwnerId' => Yii::t('app','Bank Owner ID'),
            'money' => Yii::t('app','Amount'),
            'transactionDate' => Yii::t('app', 'Transaction Date'),
            'status' => Yii::t('app','Status'),
            'userId' => Yii::t('app','User ID'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
            'chanelBankId' => Yii::t('app','Chanel Bank'),
            'transactionNumber' => Yii::t('app','Transaction Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBankOwner()
    {
        return $this->hasOne(BankOwner::className(), ['id' => 'bankOwnerId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }


    public function getChanelBank()
    {
        return $this->hasOne(ChanelBank::className(), ['id' => 'chanelBankId']);
    }
}
