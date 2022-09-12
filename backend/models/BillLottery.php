<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_bill_lottery".
 *
 * @property int $id
 * @property string $name
 * @property string $idBuyLottery
 * @property string $createdAt
 */
class BillLottery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bill_lottery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'idBuyLottery', 'total', 'totalPaid'], 'required'],
            [['total', 'totalPaid'], 'number'],
            [['createdAt'], 'safe'],
            [['name', 'idBuyLottery'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'name' =>  Yii::t('app','Name'),
            'total' =>  Yii::t('app','Total Paly'),
            'totalPaid' => Yii::t('app','Total Pay'),
            'idBuyLottery' =>  Yii::t('app','Id Buy Lottery'),
            'createdAt' =>  Yii::t('app','Created At'),
        ];
    }

    public function getBuyLottery()
    {
        return $this->hasOne(BuyLottery::className(), ['id' => 'idBuyLottery']);
    }
}
