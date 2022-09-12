<?php
namespace common\models;

use backend\models\UserGroup;
use backend\models\WalletUser;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
use backend\models\Bank;
use yii\web\UploadedFile;
use yii\web\ServerErrorHttpException;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $lineId
 * @property string $mobile
 * @property string $profileImage
 * @property string $password write-only password
 * @property string $note
 * @property string $referCode
 * @property string $referenceReferCode
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $upload_foler ='profile';
    public $groupName;
    const STATUS_PADDING = 20;
    const STATUS_BAN = 30;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;
    public $newPassword;
    public $repeatPassword;
    public $currentPassword;

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
            [['firstName', 'lastName', 'username', 'password_hash', 'email', 'bankId', 'numberBank'], 'required'],
            [['groupName'], 'required', 'on' => 'singnup'],
            [['currentPassword', 'newPassword', 'repeatPassword'], 'required', 'on' => 'updatePassword'],
            [['currentPassword'], 'validateCurrentPassword', 'on' => 'updatePassword'],
            [['newPassword'], 'string', 'min' => 6, 'on' => 'updatePassword'],
            [['status'], 'required', 'on' => 'updateStatus'],
            [['status', 'enabled'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['birthDate'], 'date', 'format' => 'yyyy-mm-dd'],
            [['firstName', 'lastName', 'address', 'username', 'password_reset_token', 'email', 'numberBank', 'lineId', 'note'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['referCode', 'referenceReferCode'], 'string', 'max' => 6],
            [['referenceReferCode'], 'validateExists'],
            [['profileImage'], 'file', 'extensions' => ['png', 'jpg']],
            [['mobile'], 'number'],
            [['username'], 'unique'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => Yii::t('app', 'Your username can only contain alphanumeric characters, underscores and dashes.')],
            [['password_hash'], 'string', 'min' => 6],
            [['email'], 'email'],
            [['email', 'referCode'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['firstName', 'lastName', 'username', 'password_hash', 'numberBank', 'address', 'lineId'], 'filter', 'filter'=> '\yii\helpers\HtmlPurifier::process'],
            [['repeatPassword'], 'safe', 'on' => 'singnup'],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'password_hash', 'message'=> Yii::t('app',"Passwords don't match"), 'on' => 'singnup'],
            [['repeatPassword'], 'compare', 'compareAttribute' => 'newPassword', 'message'=> Yii::t('app',"Passwords don't match"), 'on' => 'updatePassword'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_BAN, self::STATUS_PADDING]],
            [['bankId'], 'exist', 'skipOnError' => true, 'targetClass' => Bank::className(), 'targetAttribute' => ['bankId' => 'id']],
        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['updateStatus'] = ['status', 'note'];
        $scenario['singnup'] = array_merge($scenario['default'], ['groupName', 'repeatPassword']);
        $scenario['updatePassword'] = ['currentPassword', 'repeatPassword', 'password_hash', 'newPassword'];
        return $scenario;
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
            'level' => Yii::t('app','Level'),
            'mobile' => Yii::t('app','Mobile'),
            'lineId' => Yii::t('app','Line Id'),
            'profileImage' => Yii::t('app','Profile Image'),
            'birthDate' => Yii::t('app','Birth Date'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'note' => Yii::t('app','Note'),
            'referCode' => Yii::t('app', 'Refer Code'),
            'referenceReferCode' => Yii::t('app', 'Reference Refer Code'),
        ];
    }


    public function validateExists()
    {
       if ($this->getReferenceReferCode() !== true) {
           $this->addError('referenceReferCode', $this->getReferenceReferCode());
       }
    }

    public function getReferenceReferCode ()
    {
        $isReferCode = User::find()->where(['referCode' => $this->referCode])->one();
        if (!$isReferCode) {
            return Yii::t('app', 'Not Found Reference Refer Code');
        }
        if ($this->referenceReferCode) {
            $countReferenceReferCode = User::find()->where(['referenceReferCode' => $this->referenceReferCode])->count();
            if ($countReferenceReferCode <= 5) {
                return true;
            } else {
                return Yii::t('app','Reference Refer Code Maximum {0}', 5);
            }
        }
    }

    public function validateCurrentPassword()
    {
        if (!$this->validatePassword($this->currentPassword)) {
            $this->addError('currentPassword', Yii::t('app','Current password incorrect'));
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['id' => 'bankId']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if (is_null($this->password_hash)){
            return false;
        }
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getFullName()
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function upload($model,$attribute)
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
        return empty($this->profileImage) ? '' : $this->getUploadUrl().$this->profileImage;
    }

    public static function itemsAlias($key)
    {

        $items = [
            'status'=>[
                self::STATUS_ACTIVE => Yii::t('app','Active'),
                self::STATUS_INACTIVE => Yii::t('app','InActive'),
                self::STATUS_PADDING => Yii::t('app', 'Pending'),
                self::STATUS_BAN => Yii::t('app','Ban'),
            ],
        ];
        return ArrayHelper::getValue($items,$key,[]);
    }

    public function getItemStatus()
    {
        return self::itemsAlias('status');
    }

    public function getItemStatusName()
    {
        return ArrayHelper::getValue($this->getItemStatus(),$this->status);
    }

    public static function findWallet($id)
    {
        $wallet = WalletUser::findOne(['userId' => $id]);
        $walletMoney = 0;
        if ($wallet) {
            $walletMoney = $wallet->total;
        }
        return $walletMoney;
    }

    public function getUserGroup()
    {
        return $this->hasMany(UserGroup::className(), ['userId' => 'id']);
    }
}
