<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_user_log".
 *
 * @property int $id
 * @property string $ipAddress
 * @property int $status 1 = login, 2 = logout
 * @property int $userId
 * @property int $createdAt
 *
 * @property User $user
 */
class UserLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ipAddress', 'status', 'userId'], 'required'],
            [['createdAt'], 'safe'],
            [['status', 'userId'], 'integer'],
            [['ipAddress'], 'string', 'max' => 255],
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
            'ipAddress' => Yii::t('app','Ip Address'),
            'status' => Yii::t('app','Status'),
            'userId' => Yii::t('app','User ID'),
            'createdAt' => Yii::t('app','Created At'),
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
