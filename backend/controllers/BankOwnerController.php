<?php

namespace backend\controllers;

use common\models\Model;
use Yii;
use backend\models\BankOwner;
use backend\models\BankOwnerSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BankOwnerController implements the CRUD actions for BankOwner model.
 */
class BankOwnerController extends Controller
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
     * Lists all BankOwner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new BankOwner();
        $searchModel = new BankOwnerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new BankOwner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new BankOwner()];
        $request = Yii::$app->request;

        if ($request->isPost) {
            $models = Model::createMultiple(BankOwner::className());
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
     * Updates an existing BankOwner model.
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

    public function actionUpdateStatus()
    {
        if (Yii::$app->request->post('editableKey')) {
            $bankOwnerId = Yii::$app->request->post('editableKey');
            $bankOwner = BankOwner::findOne(['id' => $bankOwnerId]);
            $out = Json::encode(['output' => '', 'message' => '']);
            $post = [];
            $posted = current($_POST['BankOwner']);
            $post['BankOwner'] = $posted;
            if ($bankOwner->load($post)) {
                $bankOwner->save();
                $output = $bankOwner->status == 0 ? '<span class="label label-danger">Inactive</span>' : '<span class="label label-success">Active</span>';
                $out = Json::encode(['output' => $output, 'message' => '']);
            }
            echo $out;
            return;
        }
    }

    /**
     * Deletes an existing BankOwner model.
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
     * Finds the BankOwner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BankOwner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BankOwner::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
