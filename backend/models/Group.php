<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_group".
 *
 * @property int $id
 * @property string $name
 * @property int $enabled
 * @property int $showFrontend
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property UserGroup[] $userGroups
 */
class Group extends ActiveRecord
{
    public $permission;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','showFrontend'], 'required'],
            [['name'], 'unique'],
            [['enabled', 'showFrontend'], 'integer'],
            [['createdAt', 'updatedAt', 'permission'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'showFrontend' => Yii::t('app', 'Show Frontend'),
            'enabled' => Yii::t('app', 'Enabled'),
            'permission' => Yii::t('app', 'Permission'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['groupId' => 'id']);
    }

    public static function getAdministrator()
    {
        $group = Group::find()->where(['name' => User::GROUP_NAME_ADMINISTRATOR])->one();
        return $group->id;
    }
}
