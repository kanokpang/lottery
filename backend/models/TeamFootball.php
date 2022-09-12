<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "lol_teamfootball".
 *
 * @property int $id
 * @property string $name
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $logo
 */
class TeamFootball extends ActiveRecord
{
    public $upload_foler ='team-football';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%teamfootball}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'leagueId'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['logo'], 'file', 'extensions' => ['png', 'jpg']],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'leagueId' => Yii::t('app','League Name'),
            'name' => Yii::t('app','Name'),
            'logo' => Yii::t('app', 'Logo'),
            'createdAt' => Yii::t('app','Created At'),
            'updatedAt' => Yii::t('app','Updated At'),
        ];
    }

    public function getLeague()
    {
        return $this->hasOne(Leaguefootball::className(), ['id' => 'leagueId']);
    }

    public function upload($model, $attribute)
    {
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
                return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

    public function getPhotoViewer(){
        return empty($this->logo) ? '' : $this->getUploadUrl().$this->logo;
    }
}
