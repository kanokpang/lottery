<?php

namespace frontend\controllers;

use backend\models\AnswerIssue;
use backend\models\Bank;
use backend\models\ConditionLottery;
use backend\models\FeedNews;
use backend\models\Group;
use backend\models\Information;
use backend\models\Issue;
use backend\models\UserGroup;
use backend\models\UserLog;
use backend\models\WalletUser;
use backend\models\WinLottery;
use common\models\LoginForm;
use common\models\User;
use frontend\models\ForgotPassword;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;
use backend\models\TypeLottery;

/**
 * Site controller
 */
class SiteController extends Controller
{
    const GROUP_NAME_SALE = 'ตัวแทนขาย';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['captcha', 'login', 'error'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $information = Information::findOne(['id' => 6]);
        $query = <<<EOT
SELECT * FROM `lol_lottery_period` WHERE `startDateTime` <= NOW() AND NOW() <= `endDateTime` AND status = 1 ORDER BY startDateTime ASC LIMIT 1
EOT;
        $lottery = Yii::$app->db->createCommand($query)->queryOne();
        $condtionLottery = ConditionLottery::findAll(['lotteryId' => $lottery['id']]);
        $lastLottery = WinLottery::find()->select('lotteryId')->orderBy('id DESC')->one();
        if ($lastLottery) {
            $winLotterys = WinLottery::find()->joinWith('typeLottery')->where([
                'lotteryId' => $lastLottery->lotteryId
            ])->andWhere(['NOT LIKE', TypeLottery::tableName() . '.name', 'โต๊ด'])->all();
        }
        $feedNews = FeedNews::find()->all();
        return $this->render('index', [
            'information' => $information,
            'conditionLottery' => $condtionLottery,
            'lottery' => $lottery,
            'winLotterys' => isset($winLotterys) ? $winLotterys : [],
            'feedNews' => $feedNews,
        ]);
    }

    public function actionNews($id)
    {
        $information = Information::findOne($id);
        return $this->render('news', [
            'information' => $information
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userLog = new UserLog();
            $userLog->userId = Yii::$app->user->id;
            $userLog->ipAddress = getHostByName(getHostName());
            $userLog->status = 1;
            if (!$userLog->save()) {
                throw new ServerErrorHttpException();
            }
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $userLog = new UserLog();
        $userLog->userId = Yii::$app->user->id;
        $userLog->ipAddress = getHostByName(getHostName());
        $userLog->status = 2;
        if (!$userLog->save()) {
            throw new ServerErrorHttpException();
        }
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'singnup';
        $model = new User();
        $model->scenario = 'singnup';
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank, 'id', 'name');
        $group = Group::find()->where(['showFrontend' => true])->all();
        $groupData = ArrayHelper::map($group, 'id', 'name');
        if (!$model->load(Yii::$app->request->post())) {
            return $this->render('signup', [
                'model' => $model,
                'listData' => $listData,
                'groupData' => $groupData,
            ]);
        }
        $transaction = \Yii::$app->db->beginTransaction();
        $model->referCode = Yii::$app->security->generateRandomString(6);
        try {
            if ($model->validate()) {
                $group = Group::find()->where(['id' => $model->groupName])->one();
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                if ($group->name === self::GROUP_NAME_SALE) {
                    $model->status = $model::STATUS_PADDING;
                }
                $model->save(false);
                $wallet = new WalletUser();
                $wallet->userId = $model->id;
                $referenceReferCode = $model->getReferenceReferCode();
                if ($referenceReferCode === true) {
                    $wallet->total = 25;
                } else {
                    $model->referenceReferCode = '';
                    $wallet->total = 0;
                }
                if (!$wallet->save()) {
                    throw new ServerErrorHttpException(Yii::t('app','Internal Server Error'));
                }
                $userGroup = new UserGroup();
                $userGroup->userId = $model->id;
                $userGroup->groupId = $model->groupName;
                if (!$userGroup->save()) {
                    throw new ServerErrorHttpException(Yii::t('app','Internal Server Error'));
                }
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($model->groupName);
                if ($role) {
                    $auth->assign($role, $model->id);
                }
                if ($userGroup->group->name === self::GROUP_NAME_SALE) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => 'สมัครสมาชิกเสร็จเรียบร้อย!. รอเจ้าหน้าที่ตรวจสอบและทำการยืนยัน',
                        'options' => ['class' => 'alert-success']
                    ]);
                } else {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => 'สมัครสมาชิกเสร็จเรียบร้อย!',
                        'options' => ['class' => 'alert-success']
                    ]);
                }
                $transaction->commit();
                return $this->redirect(['login']);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }

        return $this->render('signup', [
            'model' => $model,
            'listData' => $listData,
            'groupData' => $groupData,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionForgotPassword()
    {
        $this->layout = 'login';
        $model = new ForgotPassword();
        $model->setScenario('frontEndLogin');
        $request = Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()) {
            $model->resetPassword();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Forgot Password Success.'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->redirect('login');
        }
        return $this->render('forgotPassword', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
