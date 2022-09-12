<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $captcha;
    private $_user;
    public $reCaptcha;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            [['reCaptcha'], 'required', 'on' => 'frontEndLogin'],
            [['captcha'], 'required', 'on' => 'backendLogin'],
            [['captcha'], 'captcha', 'on' => 'backendLogin'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(),
                'secret' => '6LfN8kYUAAAAANBBDLQOOiSZakAgfTVfg0AwtDdu',
                'uncheckedMessage' => 'Please confirm that you are not a bot.',
                'on' => 'frontEndLogin']

        ];
    }

    public function scenarios()
    {
        $scenario = parent::scenarios();
        $scenario['backendLogin'] = array_merge($scenario['default'], ['captcha']);
        $scenario['frontEndLogin'] = array_merge($scenario['default'], ['reCaptcha']);
        return $scenario;
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $userGroup = $this->getUser()->userGroup;
            $groupNameByUser = count($userGroup) ? $userGroup[0]->group->name : [];
            if ($groupNameByUser === \backend\models\User::GROUP_NAME_SALE && $this->scenario === 'backendLogin' ||
                $groupNameByUser === \backend\models\User::GROUP_NAME_USER && $this->scenario === 'backendLogin') {
                return false;
            }
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
