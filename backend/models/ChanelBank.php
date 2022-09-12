<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_chanel_bank".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 *
 * @property TransferMoney[] $transferMoneys
 */
class ChanelBank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%chanel_bank}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['createdAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' => Yii::t('app','Name'),
            'createdAt' => Yii::t('app','Created At'),
        ];
    }
}
