<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_visitor".
 *
 * @property int $id
 * @property string $ip
 * @property string $visitorByDate
 * @property string $createdAt
 */
class Visitor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%visitor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitorByDate', 'createdAt'], 'safe'],
            [['ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'ip' => Yii::t('app','Ip'),
            'visitorByDate' => Yii::t('app','Visitor By Date'),
            'createdAt' => Yii::t('app','Created At'),
        ];
    }
}
