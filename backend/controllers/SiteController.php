<?php
namespace backend\controllers;

use backend\models\BillLottery;
use backend\models\BuyLottery;
use backend\models\ConditionLottery;
use backend\models\Group;
use backend\models\Issue;
use backend\models\Lottery;
use backend\models\OrderLottery;
use backend\models\PaymentLottery;
use backend\models\TransferMoney;
use backend\models\User;
use backend\models\UserGroup;
use backend\models\UserLog;
use backend\models\Visitor;
use backend\models\WithdrawMoney;
use DateTime;
use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\ServerErrorHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['captcha', 'login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'dashboard3', 'dashboard2'],
                        'allow' => true,
                        'roles' => ['@'],
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
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($lotteryId = null)
    {
        $buyLotteryTableName = BuyLottery::tableName();
        $billLotteryTableName = BillLottery::tableName();
        $userTableName = User::tableName();
        if ($lotteryId) {
            $queryUserNormal = <<<EOT
SELECT COUNT(number) as count , number FROM $buyLotteryTableName
WHERE lotteryId = $lotteryId
GROUP BY number ORDER BY count DESC LIMIT 10
EOT;
            $billquery = <<<EOT
SELECT COUNT($billLotteryTableName.userId) as count, $billLotteryTableName.userId, $userTableName.firstName, $userTableName.lastName FROM $billLotteryTableName 
INNER JOIN $userTableName ON $billLotteryTableName.userId = $userTableName.id 
INNER JOIN $buyLotteryTableName ON $billLotteryTableName.idBuyLottery = $buyLotteryTableName.id
WHERE lotteryId = $lotteryId
GROUP BY $billLotteryTableName.userId ORDER BY count DESC LIMIT 10
EOT;
            $billByUserQuery = <<<EOT
SELECT $userTableName.firstName, $userTableName.lastName, $billLotteryTableName.totalPaid, $billLotteryTableName.userId FROM $billLotteryTableName
INNER JOIN $userTableName ON $billLotteryTableName.userId = $userTableName.id
INNER JOIN $buyLotteryTableName ON $billLotteryTableName.idBuyLottery = $buyLotteryTableName.id
WHERE lotteryId = $lotteryId
GROUP BY $billLotteryTableName.userId ORDER BY totalPaid DESC LIMIT 10
EOT;

        } else {
            $queryUserNormal = <<<EOT
SELECT COUNT(number) as count , number FROM $buyLotteryTableName
GROUP BY number ORDER BY count DESC LIMIT 10
EOT;
            $billquery = <<<EOT
SELECT COUNT(userId) as count, userId,firstName,lastName FROM $billLotteryTableName 
INNER JOIN $userTableName ON $billLotteryTableName.userId = $userTableName.id GROUP BY userId ORDER BY count DESC LIMIT 10
EOT;
            $billByUserQuery = <<<EOT
SELECT $userTableName.firstName, $userTableName.lastName, $billLotteryTableName.totalPaid, $billLotteryTableName.userId FROM $billLotteryTableName
INNER JOIN $userTableName ON $billLotteryTableName.userId = $userTableName.id
GROUP BY $billLotteryTableName.userId ORDER BY totalPaid DESC LIMIT 10
EOT;
        }
        $lottery = Lottery::find()->orderBy('id DESC')->limit(1)->one();
        $lotterys = Lottery::find()->where(['status' => 1])->all();
        $listLottery = ArrayHelper::map($lotterys,'id','name');
        $groupNormal = Group::find()->where(['name' => 'ผู้ใช้ทั่วไป'])->one();
        $groupAgenet = Group::find()->where(['name' => 'ตัวแทนขาย'])->one();
        $data = [];
        $dataBillLottery = [];
        $countUserNormalWeek = 0;
        $countNewOrder = 0;
        $countUserAgentWeek = 0;
        $totalMoneyPay = 0;
        if($lottery) {
            $countNewOrder = OrderLottery::find()->where(['orderLotteryId' => $lottery->id])->count();
            $countUserNormalWeek = UserGroup::find()->joinWith('user')->where(
                'yearweek(DATE(' . User::tableName() . '.createdAt), 1) = yearweek(curdate(), 1)')
                ->andWhere([User::tableName() . '.status' => 10, 'groupId' => $groupNormal->id])->count();
            $countUserAgentWeek = UserGroup::find()->joinWith('user')->where(
                'yearweek(DATE(' . User::tableName() . '.createdAt), 1) = yearweek(curdate(), 1)')
                ->andWhere([User::tableName() . '.status' => 10, 'groupId' => $groupAgenet->id])->count();
            $buyPreviousMonths = BuyLottery::find()->where('MONTH(createdAt) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)')->all();
            $totalTrue = 0;
            $totalFalse = 0;
            foreach ($buyPreviousMonths as $buyPreviousMonth) {
                if ($buyPreviousMonth->isTrue === 1) {
                    $totalTrue += $buyPreviousMonth->moneyPay;
                } elseif ($buyPreviousMonth->isTrue === 2) {
                    $totalFalse += $buyPreviousMonth->moneyPay;
                }
            }
            $totalMoneyPay = $totalFalse - $totalTrue;
            $data = Yii::$app->db->createCommand($queryUserNormal)->queryAll();
            $dataBillLottery = Yii::$app->db->createCommand($billquery)->queryAll();
            $dataUserBillLottery = Yii::$app->db->createCommand($billByUserQuery)->queryAll();
        }
        return $this->render('index',[
            'data' => $data,
            'dataBillLottery' => $dataBillLottery,
            'countNewOrder' => $countNewOrder,
            'countUserNormalWeek' => $countUserNormalWeek,
            'countUserAgentWeek' => $countUserAgentWeek,
            'totalMoneyPay' => $totalMoneyPay,
            'listLottery' => $listLottery,
            'dataUserBillLottery' => isset($dataUserBillLottery) ? $dataUserBillLottery : [],
            'lotteryId' => $lotteryId
        ]);
    }

    public function actionDashboard2($date = null, $endDate = null, $type = 'etc')
    {
        $countIssue = Issue::find()->count();
        $sumWithDrawMoney = WithdrawMoney::find()->select('SUM(money) as money')->where(['status' => 1])->one();
        $sumTransferMoney = TransferMoney::find()->select('SUM(money) as money')->where(['status' => 1])->one();
        $format = 'Y-m-d H:i:s';
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        if (!$dateTime) {
            $dateTime = new DateTime();
        }
        $weekString = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $monthString = ['1' => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $function = 'hour';
        $counter = 24;

        if ($type === 'week') {
            $function = 'weekday';
            $counter = 7;
        }

        if ($type === 'month') {
            $function = 'day';
            $counter = cal_days_in_month(CAL_GREGORIAN,
                $dateTime->format('m'),
                $dateTime->format('Y')
            );
        }

        if ($type === 'year') {
            $function = 'month';
            $counter = 12;
        }
		
		if ($type === 'etc') {
			$date1 = date_create($date);
			$date2 = date_create($endDate);
			$diff = date_diff($date1, $date2);
			$counter = $diff->days;
		}

        $reportDataUserNormal = [];
        $reportDataUserSale = [];
		if ($type === 'etc') {
			$borders['startDate'] = new DateTime($date);
            $borders['endDate'] =new DateTime($endDate);
			$startDate = $borders['startDate']->setTime(0, 0, 0)->format($format);
			$endDate = $borders['endDate']->setTime(23, 59, 59)->format($format);
		} else {
			$borders = $this->getBorders($dateTime, $type);
			$startDate = $borders['startDate']->setTime(0, 0, 0)->format($format);
			$endDate = $borders['endDate']->setTime(23, 59, 59)->format($format);
		}
        $userGroups = UserGroup::find()->joinWith('group')->where(['name' => 'ผู้ใช้ทั่วไป'])->orWhere(['name' => 'ตัวแทนขาย'])->all();
        $saleUserId = [];
        $normalUserId = [];
        foreach ($userGroups as $userGroup) {
            if ($userGroup->group->name == 'ผู้ใช้ทั่วไป') {
                $normalUserId[] = $userGroup->userId;
            } else {
                $saleUserId[] = $userGroup->userId;
            }
        }
        if (isset($normalUserId) || isset($saleUserId)) {
            $normalUserId = implode(',', array_map('intval', $normalUserId));
            $saleUserId = implode(',', array_map('intval', $saleUserId));
            $tableName = BillLottery::tableName();
            $queryUserNormal = <<<EOT
SELECT $function(`createdAt`) AS period, SUM(total) AS count FROM $tableName
WHERE `createdAt` >= '$startDate'
AND `createdAt` <= '$endDate'
AND `userId` IN ('$normalUserId')
GROUP BY period;
EOT;
            $queryUserSale = <<<EOT
SELECT $function(`createdAt`) AS period, SUM(total) AS count FROM $tableName
WHERE `createdAt` >= '$startDate'
AND `createdAt` <= '$endDate'
AND `userId` IN ('$saleUserId')
GROUP BY period;
EOT;
            $itemsUserNormal = Yii::$app->db->createCommand($queryUserNormal)->queryAll();
            $itemsUserSale = Yii::$app->db->createCommand($queryUserSale)->queryAll();
            foreach ($itemsUserNormal as $item) {
                $reportDataUserNormal[$item['period']] = intval($item['count']);
            }
            foreach ($itemsUserSale as $item) {
                $reportDataUserSale[$item['period']] = intval($item['count']);
            }
            if ($type === 'month' || $type === 'year') {
                for ($i = 1; $i <= $counter; $i++) {
                    if (!array_key_exists($i, $reportDataUserNormal)) {
                        $reportDataUserNormal[$i] = 0;
                    }
                    if (!array_key_exists($i, $reportDataUserSale)) {
                        $reportDataUserSale[$i] = 0;
                    }
                }
            } else {
                for ($i = 0; $i < $counter; $i++) {
                    if (!array_key_exists($i, $reportDataUserNormal)) {
                        $reportDataUserNormal[$i] = 0;
                    }
                    if (!array_key_exists($i, $reportDataUserSale)) {
                        $reportDataUserSale[$i] = 0;
                    }
                }
            }
            ksort($reportDataUserNormal);
			ksort($reportDataUserSale);
            if ($type === 'week') {
                for ($i = 0; $i < $counter; $i++) {
                    $reportDataUserNormal[$weekString[$i]] = $reportDataUserNormal[$i];
                    unset($reportDataUserNormal[$i]);
                    $reportDataUserSale[$weekString[$i]] = $reportDataUserSale[$i];
                    unset($reportDataUserSale[$i]);
                }
            }
            if ($type === 'year') {
                for ($i = 1; $i <= $counter; $i++) {
                    $reportDataUserNormal[$monthString[$i]] = $reportDataUserNormal[$i];
                    unset($reportDataUserNormal[$i]);
                    $reportDataUserSale[$monthString[$i]] = $reportDataUserSale[$i];
                    unset($reportDataUserSale[$i]);
                }
            }
        }
        $totalVisitor = Visitor::find()->count();
        return $this->render('dashboard2', [
            'date' => $date,
            'type' => $type,
            'reportDataUserNormal' => $reportDataUserNormal,
            'reportDataUserSale' => $reportDataUserSale,
            'countIssue' => $countIssue,
            'sumWithDrawMoney' => $sumWithDrawMoney,
            'sumTransferMoney' => $sumTransferMoney,
            'totalVisitor' => $totalVisitor,
			'endDate' => isset($date2) ? $date2 : null,
        ]);
    }

    public function actionDashboard3()
    {
        $lottery = Lottery::find()->where(['status' => 1])->orderBy('id DESC')->limit(1)->one();
        $countUserTrue = 0;
        $countBillLotteryTrue = 0;
        $totalMoneyPay = 0;
        $expenses = 0;
        $expensesLastLottery = 0;
        if ($lottery) {
            $countUserTrue = BuyLottery::find()->where(['isTrue' => 1])->groupBy('userId')->count();
            $buyLotterys = BuyLottery::find()->where(['isTrue' => 1])->all();
            foreach ($buyLotterys as $key => $value) {
                $idBuyLottery[] = $value->id;
                $lotteryIds[$key] = [
                    'lotteryId' => $value->lotteryId,
                    'typeLotteryId' => $value->typeLotteryId,
                    'number' => $value->number,
                    'moneyPlay' => $value->moneyPlay,
                    'paymentId' => $value->paymentId,
                ];
            }
            if (isset($idBuyLottery)) {
                $countBillLotteryTrue = BillLottery::find()->where(['idBuyLottery' => $idBuyLottery])->count();
            }
            $totalMoneyPay = BuyLottery::find()->select('SUM(moneyPay) as moneyPay')->where(['isTrue' => 2])->one();
            if (isset($lotteryIds)) {
                foreach ($lotteryIds as $lotteryId) {
                    $conditionLottery = ConditionLottery::findOne([
                        'lotteryId' => $lotteryId['lotteryId'],
                        'typeLotteryId' => $lotteryId['typeLotteryId'],
                        'number' => $lotteryId['number']
                    ]);
                    $paymentLottery = PaymentLottery::findOne(['id' => $lotteryId['paymentId']]);
                    if ($lottery->id === intval($lotteryId['lotteryId'])) {
                        $expensesLastLottery += $lotteryId['moneyPlay'] * $paymentLottery->payment;
                    }
                    $expenses += $lotteryId['moneyPlay'] * $paymentLottery->payment;
                    if ($conditionLottery) {
                        if ($conditionLottery->isPurchaseLimit) {
                            if ($lottery->id === intval($lotteryId['lotteryId'])) {
                                $expensesLastLottery += $expensesLastLottery * $conditionLottery->condition / 100;
                            }
                            $expenses += $expenses * $conditionLottery->condition / 100;
                        }
                    }
                }
            }
        }
        return $this->render('dashboard3', [
            'countUserTrue' => $countUserTrue,
            'totalMoneyPay' => $totalMoneyPay,
            'countBillLotteryTrue' => $countBillLotteryTrue,
            'expenses' => $expenses,
            'expensesLastLottery' => $expensesLastLottery
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'main-login.php';
        $model = new LoginForm();
        $model->setScenario('backendLogin');
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
     * Logout action.
     *
     * @return string
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

    function getBorders(DateTime $date, $type = 'day')
    {
        $format = 'Y-m-d';
        $borders = [];
        if ($type === 'day') {
            $borders['startDate'] = new DateTime($date->format($format));
            $borders['endDate'] = new DateTime($date->format($format));
        }
        if ($type === 'week') {
            $startDate = ($date->format('w') - 1);
            $endDate = (7 - $date->format('w'));
            if ($startDate === -1) {
                $startDate = 6;
                $endDate = 0;
            }
            $borders['startDate'] = new DateTime($date->format($format) . ' - ' . $startDate . ' days');
            $borders['endDate'] = new DateTime($date->format($format) . ' + ' . $endDate . ' days');
        }
        if ($type === 'month') {
            $borders['startDate'] = new DateTime($date->modify('first day of this month')->format($format));
            $borders['endDate'] = new DateTime($date->modify('last day of this month')->format($format));
        }
        if ($type === 'year') {
            $borders['startDate'] = new DateTime($date->modify('first day of january')->format($format));
            $borders['endDate'] =new DateTime($date->modify('last day of december')->format($format));
        }
        return $borders;
    }
}
