<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_leaguefootball".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Matchfootball[] $matchfootballs
 * @property Matchfootball[] $matchfootballs0
 * @property Matchfootball[] $matchfootballs1
 */
class Leaguefootball extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lol_leaguefootball';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'id' => 'ID',
            'name' => 'Name',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchfootballs()
    {
        return $this->hasMany(Matchfootball::className(), ['leagueId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchfootballs0()
    {
        return $this->hasMany(Matchfootball::className(), ['teamId1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchfootballs1()
    {
        return $this->hasMany(Matchfootball::className(), ['teamId2' => 'id']);
    }
}
