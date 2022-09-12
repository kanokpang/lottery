<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ForgotPassword extends Model
{
    public $password;
    public $username;
    public $birthDate;

    /**
     * @var \common\models\User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'birthDate'], 'required'],
            [['username', 'birthDate'], 'validateCorrect'],
            ['password', 'string', 'min' => 6],
            [['birthDate'], 'date', 'format' => 'yyyy-mm-dd'],
        ];
    }

    public function validateCorrect()
    {
        $user = $this->findUser();
        if (!$user) {
            $attribute = ['username', 'birthDate'];
            $this->addError('username', Yii::t('app', 'Incorrect Username and BirthDate'));
            $this->addError('birthDate', Yii::t('app', 'Incorrect Username and BirthDate'));
        }
    }

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $this->_user = $this->findUser();
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        $user = $this->_user;
        $user->setPassword($this->password);
        return $user->save(false);
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'UserName'),
            'password' => Yii::t('app', 'New Password'),
            'birthDate' => Yii::t('app', 'Birth Date'),
        ];
    }

    private function findUser()
    {
        return User::find()->where(['username' => $this->username, 'birthDate' => $this->birthDate])->one();
    }

}
