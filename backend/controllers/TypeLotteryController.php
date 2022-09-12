<?php

namespace backend\controllers;

use common\models\Model;
use Yii;
use backend\models\TypeLottery;
use backend\models\TypeLotterySearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TypeLotteryController implements the CRUD actions for TypeLottery model.
 */
class TypeLotteryController extends Controller
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
     * Lists all TypeLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TypeLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TypeLottery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new TypeLottery()];

        $request = Yii::$app->request;

        if ($request->isPost) {
            $models = Model::createMultiple(TypeLottery::className());
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

    public function actionUpdateStatus()
    {
        if (Yii::$app->request->post('editableKey')) {
            $id = Yii::$app->request->post('editableKey');
            $model = $this->findModel($id);

            $out = Json::encode(['output' => '', 'message' => '']);
            $post = [];
            $posted = current($_POST['TypeLottery']);
            $post['TypeLottery'] = $posted;
            if ($model->load($post)) {
                $model->save();
                $output = $model->status == 0 ? '<span class="label label-danger">'.Yii::t('app','Un Enabled').'</span>' :
                    '<span class="label label-success">'.Yii::t('app','Enabled').'</span>';
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            echo $out;
            return;
        }
    }
    /**
     * Updates an existing TypeLottery model.
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
     * Deletes an existing TypeLottery model.
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
     * Finds the TypeLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TypeLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypeLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
