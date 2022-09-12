<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "lol_bill_football".
 *
 * @property int $id
 * @property string $name
 * @property int $buyId
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property BuyFootball $buy
 * @property User $createdBy0
 */
class BillFootball extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bill_football}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'buyId'], 'required'],
            [['buyId', 'createdBy'], 'integer'],
            [['createdAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['buyId'], 'exist', 'skipOnError' => true, 'targetClass' => BuyFootball::className(), 'targetAttribute' => ['buyId' => 'id']],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'buyId' => Yii::t('app', 'Buy ID'),
            'createdAt' => Yii::t('app', 'Created At'),
            'createdBy' => Yii::t('app', 'Created By'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'createdBy',
                'updatedByAttribute' => false,
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuy()
    {
        return $this->hasOne(BuyFootball::className(), ['id' => 'buyId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
