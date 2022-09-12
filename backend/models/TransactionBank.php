<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_transaction_bank".
 *
 * @property int $id
 * @property string $bankName
 * @property string $bankNumber
 * @property double $money
 * @property int $status
 * @property int $userId
 * @property int $triggerId
 * @property int $triggerName
 * @property int $createdAt
 * @property double $total
 * @property int $createdBy
 *
 * @property User $user
 */
class TransactionBank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transaction_bank}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdBy'],
                ],
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bankName', 'bankNumber', 'money', 'status', 'triggerId', 'triggerName', 'total'], 'required'],
            [['money', 'total'], 'number'],
            [['status', 'userId', 'createdAt', 'createdBy'], 'integer'],
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
            'bankName' => Yii::t('app','Bank Name'),
            'bankNumber' => Yii::t('app','Bank Number'),
            'money' => Yii::t('app','Money'),
            'status' => Yii::t('app','Status'),
            'userId' => Yii::t('app','User ID'),
            'triggerName'  => Yii::t('app','Trigger Name'),
            'createdAt' => Yii::t('app','Created At'),
            'total' => Yii::t('app','Total'),
            'createdBy' => Yii::t('app','Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
