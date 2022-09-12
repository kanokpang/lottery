<?php

namespace backend\controllers;

use backend\models\BuyLottery;
use backend\models\ConditionLottery;
use backend\models\Lottery;
use backend\models\TransactionBank;
use backend\models\TransferMoney;
use backend\models\TypeLottery;
use backend\models\WalletUser;
use common\models\User;
use Yii;
use backend\models\WinLottery;
use backend\models\WinLotterySearch;
use common\models\Model;
use yii\base\Exception;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;
use yii\helpers\Url;

/**
 * WinLotteryController implements the CRUD actions for WinLottery model.
 */
class LotteryResultController extends Controller
{
    const NAME_DIGIT_TREE_ON = '3 ตัวบน';
    const NAME_DIGIT_TWO_ON = '2 ตัวบน';
    const NAME_DIGIT_TREE_ON_TODS = '3 ตัวบนโต๊ด';

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
     * Lists all WinLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WinLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WinLottery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WinLottery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new WinLottery()];
        $typeLotterys = TypeLottery::find()->where([
            'like', 'name', 'ล่าง'
        ])->orWhere(['like', 'name', 'วิ่ง'])->all();
        $lotterys = Lottery::find()->all();
        $request = Yii::$app->request;
        $listDataTypeLottery = ArrayHelper::map($typeLotterys, 'id', 'name');
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');

        if ($request->isPost) {
            $models = Model::createMultiple(WinLottery::className());
            Model::loadMultiple($models, $request->post());
            $valid = Model::validateMultiple($models);
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    foreach ($models as $key => $model) {
                        echo 'model: ' . $key . '<br>';
                        if ($model->treeDigitTod === '1') {
                            $typeLottery = TypeLottery::find()->where(['name' => WinLottery::NAME_DIGIT_TREE_BUTTOM_TODS])->one();
                            $treeDigitOnSplit = str_split($model->number);
                            $treeDigitTods = array();
                            $treeDigitTods[] = $treeDigitOnSplit[0] . $treeDigitOnSplit[1] . $treeDigitOnSplit[2];
                            $treeDigitTods[] = $treeDigitOnSplit[0] . $treeDigitOnSplit[2] . $treeDigitOnSplit[1];
                            $treeDigitTods[] = $treeDigitOnSplit[1] . $treeDigitOnSplit[0] . $treeDigitOnSplit[2];
                            $treeDigitTods[] = $treeDigitOnSplit[1] . $treeDigitOnSplit[2] . $treeDigitOnSplit[0];
                            $treeDigitTods[] = $treeDigitOnSplit[2] . $treeDigitOnSplit[1] . $treeDigitOnSplit[0];
                            $treeDigitTods[] = $treeDigitOnSplit[2] . $treeDigitOnSplit[0] . $treeDigitOnSplit[1];
                            foreach ($treeDigitTods as $t => $treeDigitTod) {
                                $winLottery = new WinLottery();
                                $winLottery->lotteryId = $model->lotteryId;
                                $winLottery->number = $treeDigitTod;
                                $winLottery->typeLotteryId = $typeLottery->id;
                                if (!($flag = $winLottery->save(false))) {
                                    throw new Exception();
                                }
                            }
                        } else {
                            if (!($flag = $model->save(false))) {
                                throw new Exception();
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
                }
            }
        }
        return $this->render('create', [
            'models' => $models,
            'listDataTypeLottery' => $listDataTypeLottery,
            'listDataLottery' => $listDataLottery
        ]);
    }

    public function actionCreateLottery()
    {
        $model = new WinLottery();
        $model->setScenario('create-lottery');
        $lotterys = Lottery::find()->all();
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');
        $request = Yii::$app->request;
        $transaction = \Yii::$app->db->beginTransaction();
        if ($model->load($request->post()) && $model->validate()) {
            $number = $model->number;
            $typeLotteryKeyTreeOn = TypeLottery::findOne(['name' => self::NAME_DIGIT_TREE_ON]);
            $typeLotteryKeyTwoOn = TypeLottery::findOne(['name' => self::NAME_DIGIT_TWO_ON]);
            $typeLotteryKeyTreeTods = TypeLottery::findOne(['name' => self::NAME_DIGIT_TREE_ON_TODS]);
            if (!$typeLotteryKeyTreeOn || !$typeLotteryKeyTwoOn || !$typeLotteryKeyTreeTods) {
                if (!$typeLotteryKeyTreeOn) {
                    $message = self::NAME_DIGIT_TREE_ON;
                } elseif (!$typeLotteryKeyTwoOn) {
                    $message = self::NAME_DIGIT_TWO_ON;
                } else {
                    $message = self::NAME_DIGIT_TREE_ON_TODS;
                }
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => 'ยังไม่ได้สร้างประเภท lottery ' . $message,
                    'options' => ['class' => 'alert-danger']
                ]);
                return $this->redirect('index');
            } else {
                $substrNumber = substr($number, 3);
                $treeDigitOn[] = substr($number, 3);
                $twoDigitOn[] = substr($number, 4);
                $treeDigitOnSplit = str_split($substrNumber);
                $treeDigitTods[] = $treeDigitOnSplit[0] . $treeDigitOnSplit[1] . $treeDigitOnSplit[2];
                $treeDigitTods[] = $treeDigitOnSplit[0] . $treeDigitOnSplit[2] . $treeDigitOnSplit[1];
                $treeDigitTods[] = $treeDigitOnSplit[1] . $treeDigitOnSplit[0] . $treeDigitOnSplit[2];
                $treeDigitTods[] = $treeDigitOnSplit[1] . $treeDigitOnSplit[2] . $treeDigitOnSplit[0];
                $treeDigitTods[] = $treeDigitOnSplit[2] . $treeDigitOnSplit[1] . $treeDigitOnSplit[0];
                $treeDigitTods[] = $treeDigitOnSplit[2] . $treeDigitOnSplit[0] . $treeDigitOnSplit[1];
                $numbers = array_merge($treeDigitOn, $twoDigitOn, $treeDigitTods);
                try {
                    foreach ($numbers as $key => $number) {
                        if ($key === 0) {
                            $typeLottery = $typeLotteryKeyTreeOn->id;
                        } elseif ($key === 1) {
                            $typeLottery = $typeLotteryKeyTwoOn->id;
                        } else {
                            $typeLottery = $typeLotteryKeyTreeTods->id;
                        }
                        $winLottery = new WinLottery();
                        $winLottery->typeLotteryId = $typeLottery;
                        $winLottery->number = $number;
                        $winLottery->lotteryId = $model->lotteryId;
                        if (!$winLottery->save(false)) {
                            throw new Exception();
                        }
                    }
                    $transaction->commit();
                    return $this->redirect('index');
                } catch (Exception $e) {
                    $transaction->rollBack();
                    Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
                }
            }
        }
        return $this->render('lottery', [
            'model' => $model,
            'listDataLottery' => $listDataLottery,
        ]);
    }

    /**
     * Updates an existing WinLottery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $typeLotterys = TypeLottery::find()->all();
        $lotterys = Lottery::find()->all();
        $listDataTypeLottery = ArrayHelper::map($typeLotterys, 'id', 'name');
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'listDataTypeLottery' => $listDataTypeLottery,
            'listDataLottery' => $listDataLottery
        ]);
    }

    public function actionAnswer($id)
    {
        $currentUrl = Yii::$app->request->referrer;
        $query_str = parse_url($currentUrl, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        $model = $this->findModel($id);
        $now = date('Y-m-d H:i:s');
        if ($model->lottery->endDateTime >= $now) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => 'เวลาในการขาย lottery ยังไม่หมด',
                'options' => ['class' => 'alert-danger']
            ]);
            return $this->redirect('index');
        }
        $lotteryId = $model->lotteryId;
        $typeLotteryId = $model->typeLotteryId;
        $number = $model->number;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->answer = 1;
            if (!$model->save(false)) {
                throw new ServerErrorHttpException();
            }
            $buyLotterys = BuyLottery::find()->where([
                'lotteryId' => $lotteryId,
                'typeLotteryId' => $typeLotteryId,
            ])->all();
            foreach ($buyLotterys as $buyLottery) {
                if ($buyLottery->number === $number) {
                    $buyLottery->isTrue = 1;
                } else {
                    $buyLottery->isTrue = 2;
                }
                if (!$buyLottery->save()) {
                    throw new ServerErrorHttpException();
                }
                $conditionLottery = ConditionLottery::findOne([
                    'lotteryId' => $lotteryId,
                    'typeLotteryId' => $typeLotteryId,
                    'number' => $model->number
                ]);
                if ($buyLottery->isTrue === 1) {
                    $money = $buyLottery->moneyPlay * $buyLottery->payment->payment;
                    if ($conditionLottery) {
                        if ($conditionLottery->isPurchaseLimit) {
                            $money = $money * $conditionLottery->condition / 100;
                        }
                    }
                    $tranferMoney = new TransferMoney();
                    $tranferMoney->transactionNumber = date("Ymd").'-LT'.rand(1,10000);
                    $tranferMoney->userId = $buyLottery->userId;
                    $tranferMoney->money = $money;
                    $tranferMoney->status = 1;
                    $user = User::findOne(['id' => $buyLottery->userId]);
                    $tranferMoney->bankOwnerId = $user->bankId;
                    if (!$tranferMoney->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $walletUser = WalletUser::findOne(['userId' => $user->id]);
                    $walletUser->total += $tranferMoney->money;
                    if (!$walletUser->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $transactionBank = new TransactionBank();
                    $transactionBank->money = $tranferMoney->money;
                    $transactionBank->bankName = $user->bank->name;
                    $transactionBank->bankNumber = $user->numberBank;
                    $transactionBank->status = $tranferMoney->status;
                    $transactionBank->triggerId = $tranferMoney->id;
                    $transactionBank->total = $walletUser->total;
                    $transactionBank->triggerName = 'ค่าหวย';
                    if (!$transactionBank->save()) {
                        throw new ServerErrorHttpException();
                    }
                }
            }
            $transaction->commit();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => 'เฉลย lottery เรียบร้อยแล้ว',
                'options' => ['class' => 'alert-success']
            ]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
		if (isset($query_params['dp-6-page'])) {
			$urlReferrer = Url::to(['/lottery-period/index',
                'id' => 'lottery-result',
                'dp-6-page' => $query_params['dp-6-page']
            ]);
		} else {
			$urlReferrer = Url::to(['/lottery-period/index', 'id' => 'lottery-result']);
		}
        return $this->redirect($urlReferrer);
    }

    /**
     * Deletes an existing WinLottery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WinLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WinLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WinLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
