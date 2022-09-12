<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_bank_owner".
 *
 * @property int $id
 * @property string $name
 * @property string $number
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $accountName
 * @property int $status
 * @property string $code
 *
 * @property TransferMoney[] $transferMoneys
 */
class BankOwner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bank_owner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number', 'accountName', 'status'], 'required'],
            [['name', 'number', 'accountName', 'code'], 'unique', 'targetAttribute' => ['name', 'number', 'accountName', 'code']],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'number', 'accountName'], 'string', 'max' => 255],
            [['code'], 'number'],
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' =>  Yii::t('app','Account'),
            'code' => Yii::t('app','Code'),
            'number' => Yii::t('app','Number'),
            'accountName' => Yii::t('app','Account Name'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferMoneys()
    {
        return $this->hasMany(TransferMoney::className(), ['bankOwnerId' => 'id']);
    }

    public function getBankName()
    {
        return $this->name.'-'.$this->number;
    }
}
