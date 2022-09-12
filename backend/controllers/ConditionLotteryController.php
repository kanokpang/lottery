<?php

namespace backend\controllers;

use backend\models\Lottery;
use backend\models\TypeLottery;
use common\models\Model;
use Yii;
use backend\models\ConditionLottery;
use backend\models\ConditionLotterySearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConditionLotteryController implements the CRUD actions for ConditionLottery model.
 */
class ConditionLotteryController extends Controller
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
     * Lists all ConditionLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConditionLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConditionLottery model.
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
     * Creates a new ConditionLottery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new ConditionLottery()];
        $lotterys = Lottery::find()->all();
        $listData = ArrayHelper::map($lotterys, 'id', 'name');
        $request = Yii::$app->request;
        $typeLotterys = TypeLottery::find()->where(['status' => '1'])->all();
        $listDataTypeLottery = ArrayHelper::map($typeLotterys,'id','name');

        if ($request->isPost) {
            $models = Model::createMultiple(ConditionLottery::className());
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
            'listData' => $listData,
            'listDataTypeLottery' => $listDataTypeLottery,
        ]);
    }

    /**
     * Updates an existing ConditionLottery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $lotterys = Lottery::find()->all();
        $listData = ArrayHelper::map($lotterys, 'id', 'name');
        $typeLotterys = TypeLottery::find()->where(['status' => '1'])->all();
        $listDataTypeLottery = ArrayHelper::map($typeLotterys,'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listData' => $listData,
            'listDataTypeLottery' => $listDataTypeLottery,
        ]);
    }

    /**
     * Deletes an existing ConditionLottery model.
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
     * Finds the ConditionLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConditionLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConditionLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
