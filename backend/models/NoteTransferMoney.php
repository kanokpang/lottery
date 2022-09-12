<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "lol_note_transfer_money".
 *
 * @property int $id
 * @property string $note
 * @property string $photos
 * @property int $idTransferMoney
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property TransferMoney $transferMoney
 */
class NoteTransferMoney extends ActiveRecord
{
    public $upload_foler = 'uploads';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%note_transfer_money}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['note', 'idTransferMoney'], 'required'],
            [['photos'], 'file',
                'skipOnEmpty' => true,
                'maxFiles' => 5,
                'extensions' => 'png,jpg'
            ],
            [['note'], 'string'],
            [['idTransferMoney'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['idTransferMoney'], 'exist', 'skipOnError' => true, 'targetClass' => TransferMoney::className(), 'targetAttribute' => ['idTransferMoney' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'note' => Yii::t('app', 'Note'),
            'photos' => Yii::t('app', 'Photos'),
            'idTransferMoney' => Yii::t('app', 'Transfer Money'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updateAt' => Yii::t('app', 'Update At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransferMoney()
    {
        return $this->hasOne(TransferMoney::className(), ['id' => 'idTransferMoney']);
    }

    public function uploadMultiple($model, $attribute)
    {
        $photos = UploadedFile::getInstances($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photos !== null) {
            $filenames = [];
            foreach ($photos as $file) {
                $filename = md5($file->baseName . time()) . '.' . $file->extension;
                if ($file->saveAs($path . $filename)) {
                    $filenames[] = $filename;
                }
            }
            if ($model->isNewRecord) {
                return implode(',', $filenames);
            } else {
                return implode(',', (ArrayHelper::merge($filenames, $this->getOwnPhotosToArray())));
            }
        }

        return $model->isNewRecord ? false : $this->getOldAttribute($attribute);
    }

    public function getPhotosViewer()
    {
        $photos = $this->photos ? @explode(',', $this->photos) : [];
        $images = [];
        foreach ($photos as $photo) {
            $images[] = $this->getUploadUrl() . $photo;
        }
        return $images;
    }

    public function getOwnPhotosToArray()
    {
        return $this->getOldAttribute('photos') ? @explode(',', $this->getOldAttribute('photos')) : [];
    }

    public function getUploadPath()
    {
        return Yii::getAlias('@webroot') . '/' . $this->upload_foler . '/';
    }

    public function getUploadUrl()
    {
        return Yii::getAlias('@web') . '/' . $this->upload_foler . '/';
    }

}
