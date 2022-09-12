<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_menu".
 *
 * @property int $id
 * @property string $url
 * @property string $name
 * @property int $parentId
 * @property string $detail
 * @property int $status
 * @property string $createdAt
 * @property string $updatedAt
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'required'],
            [['parentId', 'status'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['url', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'name' => Yii::t('app', 'Name'),
            'parentId' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app','Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }
}
