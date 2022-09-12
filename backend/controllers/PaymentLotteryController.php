<?php

namespace backend\controllers;

use backend\models\PromotionLottery;
use common\models\Model;
use Yii;
use backend\models\PaymentLottery;
use backend\models\PaymentLotterySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use backend\models\Lottery;
use backend\models\TypeLottery;

/**
 * PaymentLotteryController implements the CRUD actions for PaymentLottery model.
 */
class PaymentLotteryController extends Controller
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
     * Lists all PaymentLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $typeLottery = TypeLottery::find()->all();
        $listTypeLottery = ArrayHelper::map($typeLottery,'id','name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listTypeLottery' => $listTypeLottery,
        ]);
    }

    /**
     * Displays a single PaymentLottery model.
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
     * Creates a new PaymentLottery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new PaymentLottery()];
        $typeLotterys = TypeLottery::find()->all();
        $lotterys = Lottery::find()->all();
        $promotionLottery = PromotionLottery::find()->all();
        $listDataTypeLottery = ArrayHelper::map($typeLotterys, 'id', 'name');
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');
        $listDataPromotionLottery = ArrayHelper::map($promotionLottery, 'id', 'name');
        $request = Yii::$app->request;
        if ($request->isPost) {
            $models = Model::createMultiple(PaymentLottery::className());
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
            'listDataTypeLottery' => $listDataTypeLottery,
            'listDataLottery' => $listDataLottery,
            'listDataPromotionLottery' => $listDataPromotionLottery
        ]);
    }

    /**
     * Updates an existing PaymentLottery model.
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
        $promotionLottery = PromotionLottery::find()->all();
        $listDataTypeLottery = ArrayHelper::map($typeLotterys, 'id', 'name');
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');
        $listDataPromotionLottery = ArrayHelper::map($promotionLottery, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listDataTypeLottery' => $listDataTypeLottery,
            'listDataLottery' => $listDataLottery,
            'listDataPromotionLottery' => $listDataPromotionLottery
        ]);
    }

    /**
     * Deletes an existing PaymentLottery model.
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
     * Finds the PaymentLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
