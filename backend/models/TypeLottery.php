<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_type_lottery".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $status
 *
 * @property PaymentLottery[] $paymentLotteries
 */
class TypeLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%type_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['status'],'integer'],
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
            'name' => Yii::t('app', 'Name Type'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app','Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentLotteries()
    {
        return $this->hasMany(PaymentLottery::className(), ['typeLotterId' => 'id']);
    }
}
