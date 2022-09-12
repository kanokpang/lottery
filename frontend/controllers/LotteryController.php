<?php

namespace frontend\controllers;

use backend\models\BillLottery;
use backend\models\BuyLottery;
use backend\models\Lottery;
use backend\models\OrderLottery;
use backend\models\OrderLotterySearch;
use backend\models\PaymentLottery;
use backend\models\PromotionLottery;
use backend\models\TransactionBank;
use backend\models\TypeLottery;
use backend\models\User;
use backend\models\UserGroup;
use backend\models\WalletUser;
use frontend\models\BuyLotterySearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 16/2/2561
 * Time: 19:08
 */
class LotteryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-all' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = <<<EOT
SELECT * FROM `lol_lottery_period` WHERE `startDateTime` <= NOW() AND NOW() <= `endDateTime` AND status = 1 ORDER BY startDateTime ASC LIMIT 1
EOT;
        $lottery = Yii::$app->db->createCommand($query)->queryAll();
        if (!$lottery) {
            throw new HttpException(404, 'The requested Item could not be found.');
        }
        return $this->render('index', [
            'lottery' => $lottery,
        ]);
    }

    public function actionPromotion($id)
    {
        $lotteryId = $id;
        $lottery = $this->checkDateTimeLottery($id);
        $userGroup = UserGroup::find()->where(['userId' => Yii::$app->user->id])->one();
        $promotions = PromotionLottery::find()->asArray()->all();
        $typeLotterys = TypeLottery::find()->asArray()->all();
        return $this->render('promotion', [
            'promotions' => $promotions,
            'typeLotterys' => $typeLotterys,
            'lottery' => $lottery,
            'lotteryId' => $lotteryId,
            'userGroup' => $userGroup,
        ]);
    }

    public function actionOrder($id, $promotionId)
    {
        $lottery = $this->checkDateTimeLottery($id);
        $request = Yii::$app->request;
        $model = new OrderLottery();
        $model->setScenario('order');
        $searchModel = new OrderLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        $typeLottery = PaymentLottery::find()->joinWith('typeLottery')->select([
            'typeLotteryId',
            PaymentLottery::tableName().'.promotionLotteryId',
            TypeLottery::tableName() . '.id',
            TypeLottery::tableName() . '.name'])->where([
            'lotteryId' => $id,
            'promotionLotteryId' => $promotionId,
            'status' => 1])->groupBy('id')->asArray()->all();
        $listData = ArrayHelper::map($typeLottery, 'id', 'name');
        $promotion = PromotionLottery::findOne(['id' => $promotionId]);
        $userGroup = UserGroup::find()->where(['userId' => Yii::$app->user->id])->one();
        if ($promotion->name === $promotion::PROMOTION_SALE && $userGroup->group->name !== User::GROUP_NAME_SALE) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have buy promotion'));
        }
        if ($request->isPost) {
            $model->load($request->post());
            $paymentLottery = PaymentLottery::find()->where(['lotteryId' => $id,
                'promotionLotteryId' => $promotionId,
                'typeLotteryId' => $model->typeLotteryId
            ])->one();
            $model->OrderlotteryId = $id;
            $model->paymentId = $paymentLottery->id;
            $model->moneyPay = $model->moneyPlay - ($model->moneyPlay * $paymentLottery->discount / 100);
            $model->userId = Yii::$app->user->id;
            if ($model->validate()) {
                $model->save();
                $model = new OrderLottery();
            }
        }
        return $this->render('order', [
            'lottery' => $lottery,
            'promotion' => $promotion,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listData' => $listData,
            'lotteryId' => $id,
        ]);
    }

    public function actionBuy($id)
    {
        $lottery = $this->checkDateTimeLottery($id);
        $orders = OrderLottery::find()->where(['userId' => Yii::$app->user->id, 'OrderlotteryId' => $id, 'isExistBuy' => 0])->all();
        if (!$orders) {
            throw new BadRequestHttpException(Yii::t('app', 'Not Found Order !! Please check again'));
        }
        $transaction = Yii::$app->db->beginTransaction();
        $idBuy = '';
        $countOrder = count($orders);
        $totalMoneyPlay = 0;
        $totalMoneyPaid = 0;
        try {
            foreach ($orders as $key => $order) {
                $order->isExistBuy = 1;
                if (!$order->save()) {
                    throw new ServerErrorHttpException();
                }
                $key++;
                $model = new BuyLottery();
                $model->number = $order['number'];
                $model->moneyPlay = $order['moneyPlay'];
                $model->moneyPay = $order['moneyPay'];
                $model->paymentId = $order['paymentId'];
                $model->userId = $order['userId'];
                $model->typeLotteryId = $order['typeLotteryId'];
                $model->lotteryId = $order['OrderlotteryId'];
                $totalMoneyPlay += $model->moneyPlay;
                $totalMoneyPaid += $model->moneyPay;
                if (!$model->save()) {
                    throw new ServerErrorHttpException();
                }
                if ($countOrder > 1) {
                    $idBuy .= $model->id;
                    $idBuy .= $countOrder === $key ? '' : ',';
                } else {
                    $idBuy .= $model->id;
                }
            }
            $total = $totalMoneyPlay;
            $totalPaid = $totalMoneyPaid;
            $lastIdBill = BillLottery::find()->select(['id'])->orderBy(['id' => SORT_DESC])->limit(1)->one();
            if ($lastIdBill) {
                $lastIdBill = $lastIdBill->id++;
            } else {
                $lastIdBill = 1;
            }
            $lastId = str_pad($lastIdBill, 5, '0', STR_PAD_LEFT);
            $billLottery = new BillLottery();
            $billLottery->name = 'BLLT' . Yii::$app->formatter->asDate($lottery->startDateTime, 'yyyyMMdd') . '-' . $lastId;
            $billLottery->idBuyLottery = $idBuy;
            $billLottery->userId = Yii::$app->user->id;
            $billLottery->total = $total;
            $billLottery->totalPaid = $totalPaid;
            if (!$billLottery->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::findOne(['userId' => Yii::$app->user->id]);
            $wallet->total -= $totalPaid;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $totalPaid;
            $transactionBank->bankName = Yii::$app->user->identity->bank->name;
            $transactionBank->bankNumber = Yii::$app->user->identity->numberBank;
            $transactionBank->status = 1;
            $transactionBank->triggerId = Yii::$app->user->id;
            $transactionBank->triggerName = 'แทงหวย';
            $transactionBank->userId = $model->userId;
            $transactionBank->total = $wallet->total;
            if (!$transactionBank->save()) {
                throw new ServerErrorHttpException();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        $model = $this->findModel($billLottery->id);
        $idBuyLotterys = explode(',', $model->idBuyLottery);
        $query = BuyLottery::find()->where([BuyLottery::tableName() . '.id' => $idBuyLotterys])->joinWith(['typeLottery', 'payment']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $totalMoneyPlay = 0;
        $totalMoneyPay = 0;
        $buyLotterys = $query->asArray()->all();
        $promotionLotteryId = $buyLotterys[0]['payment']['promotionLotteryId'];
        foreach ($buyLotterys as $buyLottery) {
            $totalMoneyPlay += $buyLottery['moneyPlay'];
            $totalMoneyPay += $buyLottery['moneyPay'];
        }

        return $this->render('buy', [
            'lottery' => $lottery,
            'model' => $model,
            'dataProvider' => $dataProvider,
            'totalMoneyPlay' => $totalMoneyPlay,
            'totalMoneyPay' => $totalMoneyPay,
            'promotionLotteryId' => $promotionLotteryId,
        ]);
    }

    public function actionDelete($id)
    {
        $order = OrderLottery::findOne(['id' => $id]);
        $lottery = $this->checkDateTimeLottery($order->OrderlotteryId);
        $order->delete();

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteAll($lotteryId)
    {
        OrderLottery::deleteAll(['orderLotteryId' => $lotteryId, 'isExistBuy' => 0]);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLotteryResult()
    {
        $searchModel = new BuyLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('lottery-result', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public static function checkDateTimeLottery($id)
    {
        $lottery = Lottery::findOne(['id' => $id]);
        $date = date('Y-m-d H:i:s');
        if ($lottery->startDateTime >= $date || $lottery->endDateTime <= $date) {
            throw new NotFoundHttpException(Yii::t('app', 'Time Out Buy Lottery!! Please again'));
        }
        return $lottery;
    }

    protected function findModel($id)
    {
        if (($model = BillLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}