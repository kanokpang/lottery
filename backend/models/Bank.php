<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_bank".
 *
 * @property int $id
 * @property string $name
 * @property int $enabled
 * @property string code
 * @property int status
 * @property string $createdAt
 * @property string $updatedAt
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'status'], 'required'],
            [['name', 'code'], 'unique', 'targetAttribute' => ['name', 'code']],
            [['createdAt', 'updatedAt'], 'safe'],
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
            'code' => Yii::t('app','Code'),
            'status' => Yii::t('app','Status'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }
}
