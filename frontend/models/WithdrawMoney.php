<?php

namespace frontend\models;

use backend\models\TransferMoney;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_withdraw_money".
 *
 * @property int $id
 * @property string $bankName
 * @property string $bankNumber
 * @property double $money
 * @property int $status
 * @property int $userId
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $createdBy
 *
 * @property User $user
 */
class WithdrawMoney extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%withdraw_money}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createdBy',
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
            [['bankName', 'bankNumber', 'money'], 'required'],
            [['status'], 'default', 'value' => 0],
            [['money'], 'validateWallet'],
            [['money'], 'number', 'min' => '200'],
            [['money'], 'number'],
            [['status', 'userId', 'createdBy'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['bankName', 'bankNumber'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'bankName' => Yii::t('app','Account Name'),
            'bankNumber' => Yii::t('app','Number Bank'),
            'money' => Yii::t('app','Amount'),
            'status' => Yii::t('app','Status'),
            'userId' => Yii::t('app','User ID'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
            'transactionNumber' => Yii::t('app','Transaction Number'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function validateWallet()
    {
        if ($this->money > \common\models\User::findWallet($this->userId)) {
            return $this->addError('money',Yii::t('app', 'Not enough money.'));
        }
    }
}
