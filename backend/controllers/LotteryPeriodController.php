<?php

namespace backend\controllers;

use backend\models\BuyLottery;
use backend\models\ConditionLotterySearch;
use backend\models\PaymentLotterySearch;
use backend\models\PromotionLottery;
use backend\models\PromotionLotterySearch;
use backend\models\TypeLottery;
use backend\models\TypeLotterySearch;
use backend\models\WinLotterySearch;
use common\models\Model;
use backend\models\BuyLotterySearch;
use Yii;
use backend\models\Lottery;
use backend\models\LotterySearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LotteryController implements the CRUD actions for Lottery model.
 */
class LotteryPeriodController extends Controller
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
     * Lists all Lottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $promotionLotterySearchModel = new PromotionLotterySearch();
        $promotionLotteryDataProvider = $promotionLotterySearchModel->search(Yii::$app->request->queryParams);
        $typeLotterySearchModel = new TypeLotterySearch();
        $typeLotteryDataProvider = $typeLotterySearchModel->search(Yii::$app->request->queryParams);
        $paymentLotterySearchModel = new PaymentLotterySearch();
        $paymentLotteryDataProvider = $paymentLotterySearchModel->search(Yii::$app->request->queryParams);
        $conditionLotterySearchModel = new ConditionLotterySearch();
        $conditionLotteryDataProvider = $conditionLotterySearchModel->search(Yii::$app->request->queryParams);
        $buyLotterySearchModel = new BuyLotterySearch();
        $buyLotteryDataProvider = $buyLotterySearchModel->search(Yii::$app->request->queryParams);
        $winLotterySearchModel = new WinLotterySearch();
        $winLotteryDataProvider = $winLotterySearchModel->search(Yii::$app->request->queryParams);
        $typeLottery = TypeLottery::find()->all();
        $listTypeLottery = ArrayHelper::map($typeLottery, 'id', 'name');
        $promotionLottery = PromotionLottery::find()->all();
        $listPromotionLottery = ArrayHelper::map($promotionLottery, 'id', 'name');

        return $this->render('/layouts/lottery-tabs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'promotionLotterySearchModel' => $promotionLotterySearchModel,
            'promotionLotteryDataProvider' => $promotionLotteryDataProvider,
            'typeLotterySearchModel' => $typeLotterySearchModel,
            'typeLotteryDataProvider' => $typeLotteryDataProvider,
            'paymentLotterySearchModel' => $paymentLotterySearchModel,
            'paymentLotteryDataProvider' => $paymentLotteryDataProvider,
            'conditionLotterySearchModel' => $conditionLotterySearchModel,
            'conditionLotteryDataProvider' => $conditionLotteryDataProvider,
            'buyLotterySearchModel' => $buyLotterySearchModel,
            'buyLotteryDataProvider' => $buyLotteryDataProvider,
            'winLotterySearchModel' => $winLotterySearchModel,
            'winLotteryDataProvider' => $winLotteryDataProvider,
            'listTypeLottery' => $listTypeLottery,
            'listPromotionLottery' => $listPromotionLottery,
        ]);
    }

    /**
     * Creates a new Lottery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new Lottery()];
        $request = Yii::$app->request;
        if ($request->isPost) {
            $models = Model::createMultiple(Lottery::className());
            Model::loadMultiple($models, $request->post());
            $valid = Model::validateMultiple($models);
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    foreach ($models as $model) {
                        if (!($flag = $model->save(false))) {
                            throw new Exception();
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
        ]);
    }

    /**
     * Updates an existing Lottery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Lottery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $isExists = BuyLottery::find()->where(['lotteryId' => $id])->count();
        if ($isExists) {
            throw new HttpException('501', 'Not Deleted Because Id IsExists');
        } else {
            $this->findModel($id)->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Lottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
