<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "lol_issue".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $createdBy
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $status
 *
 * @property User $createdBy0
 */
class Issue extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%issue}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'filter', 'filter'=> '\yii\helpers\HtmlPurifier::process'],
            [['description'], 'string'],
            [['createdBy', 'status'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['status'], 'default', 'value' => 1],
            [['name'], 'string', 'max' => 255],
            [['createdBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['createdBy' => 'id']],
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
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => new Expression('NOW()'),
            ],
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
            'description' => Yii::t('app','Description'),
            'createdBy' => Yii::t('app','Created By'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
            'Status' => Yii::t('app', 'Status'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
