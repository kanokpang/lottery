<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_information".
 *
 * @property int $id
 * @property int $menuId
 * @property string $detail
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Menu $menu
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%information}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menuId'], 'required'],
            [['menuId'], 'integer'],
            [['detail'], 'string'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['menuId'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['menuId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menuId' => Yii::t('app', 'Menu ID'),
            'detail' => Yii::t('app', 'Detail'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menuId']);
    }
}
