<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "lol_wallet_user".
 *
 * @property int $id
 * @property double $total
 * @property int $userId
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property User $user
 */
class WalletUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wallet_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total', 'userId'], 'required'],
            [['userId'], 'unique'],
            [['total'], 'default', 'value' => 0],
            [['total'], 'number'],
            [['userId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'updatedAt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'total' => Yii::t('app','Total'),
            'userId' => Yii::t('app','User ID'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
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
