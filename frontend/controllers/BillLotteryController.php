<?php

namespace frontend\controllers;

use backend\models\BillLottery;
use backend\models\BillLotterySearch;
use backend\models\BuyLottery;
use backend\models\Group;
use backend\models\TransactionBank;
use backend\models\TransferMoney;
use backend\models\UserGroup;
use backend\models\WalletUser;
use common\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * BillLotteryController implements the CRUD actions for BillLottery model.
 */
class BillLotteryController extends Controller
{
    /**
     * @inheritdoc
     */
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
                ],
            ],
        ];
    }

    /**
     * Lists all BillLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        $searchModel = new BillLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleteList($id)
    {
        $model = $this->findModel($id);
        $idBuyLottery = $model->idBuyLottery;
        $idBuyLotteried = explode(',', $idBuyLottery);
        $buyLottery = \backend\models\BuyLottery::find()->where(['id' => $idBuyLotteried])->one();
        $endDateTime = $buyLottery->lottery->endDateTime;
        $endDate = date_format(date_create($endDateTime), "Y-m-d");
        $now = date('Y-m-d');
        $isAnswer = BuyLottery::find()->select('id')->where(['id' => $idBuyLotteried])->andWhere(['<>', 'isTrue', 0])->count();
        if ($endDate < $now || $isAnswer) {
            throw new NotFoundHttpException(Yii::t('app','Time out delete list lottery. Contact operator'));
        }
        $transaction = \Yii::$app->db->beginTransaction();
        $idBuyLottery = $model->idBuyLottery;
        $idBuyLotteried = explode(',',$idBuyLottery);
        try {
            $transferMoney = new TransferMoney();
            $transferMoney->bankOwnerId = Yii::$app->user->identity->bankId;
            $transferMoney->money = $model->totalPaid;
            $transferMoney->status = 1;
            $transferMoney->userId = Yii::$app->user->id;
            $transferMoney->chanelBankId = 0;
            if (!$transferMoney->save(false)) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::findOne(['userId' => Yii::$app->user->id]);
            $wallet->total += $model->totalPaid;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->totalPaid;
            $transactionBank->bankName = Yii::$app->user->identity->bank->name;
            $transactionBank->bankNumber =Yii::$app->user->identity->numberBank;
            $transactionBank->status = $transferMoney->status;
            $transactionBank->triggerId = Yii::$app->user->id;
            $transactionBank->triggerName = 'คืนเงินค่ายกเลิกหวย';
            $transactionBank->total = $wallet->total;
            $transactionBank->userId = $wallet->userId;
            if (!$transactionBank->save()) {
                throw new ServerErrorHttpException();
            }
            BuyLottery::deleteAll(['id' => $idBuyLotteried]);
            if (!$model->delete()) {
                throw new ServerErrorHttpException();
            }
            $transaction->commit();
            return $this->redirect('list');
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }
    }
    /**
     * Displays a single BillLottery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $idBuyLotterys = explode(',', $model->idBuyLottery);
        $query = BuyLottery::find()->where([BuyLottery::tableName().'.id' => $idBuyLotterys])->joinWith(['typeLottery','payment', 'lottery']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $totalMoneyPlay = 0;
        $totalMoneyPay = 0;
        $allResult = 0;
        $buyLotterys = $query->asArray()->all();
        $promotionLotteryId = $buyLotterys[0]['payment']['promotionLotteryId'];
        $lotteryName = $buyLotterys[0]['lottery']['name'];
        $lotteryEndDate = $buyLotterys[0]['lottery']['endDateTime'];
        foreach ($buyLotterys as $buyLottery) {
            $totalMoneyPlay += $buyLottery['moneyPlay'];
            $totalMoneyPay += $buyLottery['moneyPay'];
            $allResult += $buyLottery['moneyPlay'] - $buyLottery['moneyPay'];
        }

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'totalMoneyPlay' => $totalMoneyPlay,
            'totalMoneyPay' => $totalMoneyPay,
            'promotionLotteryId' => $promotionLotteryId,
            'lotteryName' => $lotteryName,
            'allResult' => $allResult,
            'lotteryEndDate' => $lotteryEndDate,
        ]);
    }

    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        $idBuyLotterys = explode(',', $model->idBuyLottery);
        $buyLottery = BuyLottery::find()->where([
            BuyLottery::tableName().'.id' => $idBuyLotterys,
        ])->joinWith('typeLottery')->all();
        $userGroup = UserGroup::findOne(['userId' => $model->buyLottery->userId]);
        $group = Group::find()->where(['id' => $userGroup->groupId])->one();
        if (!$buyLottery) {
            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'ไม่พบข้อมูล !!',
                'options'=>['class'=>'alert-warning']
            ]);
            return $this->redirect('index');
        }
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_report', [
            'model' => $model,
            'buyLottery' => $buyLottery,
            'group' => $group,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => [80, 80],
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@backend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Report Lottery'],
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }


    /**
     * Finds the BillLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BillLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
