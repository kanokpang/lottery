<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_feed_news".
 *
 * @property int $id
 * @property string $description
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property CommentFeedNews[] $commentFeedNews
 */
class FeedNews extends ActiveRecord
{
    public $captcha;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%feed_news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'captcha'], 'required'],
            [['captcha'], 'captcha'],
            [['description'], 'string'],
            [['createdAt'], 'safe'],
            [['createdBy'], 'integer'],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'createdAt' => Yii::t('app', 'Created At'),
            'createdBy' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentFeedNews()
    {
        return $this->hasMany(CommentFeedNews::className(), ['feedNewsId' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
