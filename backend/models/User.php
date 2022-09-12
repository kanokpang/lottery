<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lol_user".
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $address
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $bankId
 * @property string $numberBank
 * @property int $enabled
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $date
 *
 * @property Bank $bank
 */
class User extends \yii\db\ActiveRecord
{
    const GROUP_NAME_ADMINISTRATOR = 'Administrator';
    const GROUP_NAME_USER = 'ผู้ใช้ทั่วไป';
    const GROUP_NAME_SALE = 'ตัวแทนขาย';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'username', 'auth_key', 'password_hash', 'email', 'bankId'], 'required'],
            [['status', 'bankId', 'enabled'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['birthDate'], 'date'],
            [['firstName', 'lastName', 'address', 'username', 'password_hash', 'password_reset_token', 'email', 'numberBank'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['bankId'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bankId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstName' => Yii::t('app', 'First Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'address' => Yii::t('app', 'Address'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'bankId' => Yii::t('app', 'Name Bank'),
            'numberBank' => Yii::t('app', 'Number Bank'),
            'enabled' => Yii::t('app', 'Enabled'),
            'birthDate' => Yii::t('app','Birth Date'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bankId']);
    }

    public function getFullName()
    {
        return $this->firstName. ' ' .$this->lastName;
    }
}
