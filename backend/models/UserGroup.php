<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_user_group".
 *
 * @property int $id
 * @property int $userId
 * @property int $groupId
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Group $group
 * @property User $user
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'groupId'], 'required'],
            [['userId', 'groupId'], 'unique', 'targetAttribute' => ['userId', 'groupId']],
            [['userId', 'groupId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['groupId'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['groupId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User Name'),
            'groupId' => Yii::t('app', 'Group Name'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    public function getGroupName()
    {
        return $this->hasMany(Group::className(), ['id' => 'groupId']);
    }
}
