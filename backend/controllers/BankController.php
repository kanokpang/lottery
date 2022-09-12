<?php

namespace backend\controllers;

use backend\models\Bank;
use backend\models\BankOwner;
use backend\models\BankOwnerSearch;
use backend\models\BankSearch;
use backend\models\Group;
use backend\models\TransactionBankSearch;
use backend\models\TransferMoneySearch;
use backend\models\WalletUserSearch;
use backend\models\WithdrawMoneySearch;
use common\models\Model;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * BankController implements the CRUD actions for Bank model.
 */
class BankController extends Controller
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
     * Lists all Bank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BankSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $bankOwnerSearch = new BankOwnerSearch();
        $bankOwnerDataProvider = $bankOwnerSearch->search(Yii::$app->request->queryParams);
        $permissionName = Group::getAdministrator();
        $transferMoneySearch = new TransferMoneySearch();
        $transferMoneyDataProvider = $transferMoneySearch->search(Yii::$app->request->queryParams);
        $withdrawSearch = new WithdrawMoneySearch();
        $withdrawDataProvider = $withdrawSearch->search(Yii::$app->request->queryParams);
        $transactionSearch = new TransactionBankSearch();
        $transactionDataProvider = $transactionSearch->search(Yii::$app->request->queryParams);
        $walletSearch = new WalletUserSearch();
        $walletDataProvider = $walletSearch->search(Yii::$app->request->queryParams);
        $bankOwner = BankOwner::find()->all();

        return $this->render('/layouts/account-tabs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bankOwnerSearch' => $bankOwnerSearch,
            'bankOwnerDataProvider' => $bankOwnerDataProvider,
            'transferMoneySearch' => $transferMoneySearch,
            'transferMoneyDataProvider' => $transferMoneyDataProvider,
            'permissionName' => $permissionName,
            'withdrawSearch' => $withdrawSearch,
            'withdrawDataProvider' => $withdrawDataProvider,
            'transactionSearch' => $transactionSearch,
            'transactionDataProvider' => $transactionDataProvider,
            'walletSearch' => $walletSearch,
            'walletDataProvider' => $walletDataProvider,
            'bankOwner' => $bankOwner,
        ]);
    }

    /**
     * Displays a single Bank model.
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
     * Creates a new Bank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $models = [new Bank()];

        $request = Yii::$app->request;

        if ($request->isPost) {
            $models = Model::createMultiple(Bank::className());
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
     * Updates an existing Bank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateStatus()
    {
        if (Yii::$app->request->post('editableKey')) {
            $bankId = Yii::$app->request->post('editableKey');
            $bankOwner = Bank::findOne(['id' => $bankId]);

            $out = Json::encode(['output' => '', 'message' => '']);
            $post = [];
            $posted = current($_POST['Bank']);
            $post['Bank'] = $posted;
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
     * Deletes an existing Bank model.
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
     * Finds the Bank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bank::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
