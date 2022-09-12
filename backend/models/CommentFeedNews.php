<?php

namespace backend\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "lol_comment_feed_news".
 *
 * @property int $id
 * @property string $description
 * @property int $feedNewsId
 * @property string $createdAt
 * @property int $createdBy
 *
 * @property FeedNews $feedNews
 */
class CommentFeedNews extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%comment_feed_news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'feedNewsId'], 'required'],
            [['description'], 'string'],
            [['feedNewsId', 'createdBy'], 'integer'],
            [['createdAt'], 'safe'],
            [['feedNewsId'], 'exist', 'skipOnError' => true, 'targetClass' => FeedNews::className(), 'targetAttribute' => ['feedNewsId' => 'id']],
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
            'feedNewsId' => Yii::t('app', 'Feed News'),
            'createdAt' => Yii::t('app', 'Created At'),
            'createdBy' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedNews()
    {
        return $this->hasOne(FeedNews::className(), ['id' => 'feedNewsId']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
