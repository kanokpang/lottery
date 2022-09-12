<?php

namespace frontend\controllers;

use backend\models\Bank;
use backend\models\WalletUser;
use yii\filters\AccessControl;
use backend\models\TransactionBank;
use frontend\models\WithdrawMoney;
use common\models\User;
use frontend\models\WithdrawMoneySearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 10/2/2561
 * Time: 14:32
 */

class WithdrawController extends Controller
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
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new WithdrawMoneySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $user = $this->findUser(Yii::$app->user->id);
        $model = new WithdrawMoney();
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank,'name','name');
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'listData' => $listData,
            ]);
        }
        $model->userId = Yii::$app->user->id;
        $model->bankName = $user->bank->name;
        $model->bankNumber = $user->numberBank;
        $model->transactionNumber = date("Ymd").'-WD'.rand(1,10000);
        $model->load($request->post());
        if (!$model->validate()) {
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'listData' => $listData,
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
            $wallet->total -= $model->money;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->money;
            $transactionBank->bankName = $model->bankName;
            $transactionBank->bankNumber = $model->bankNumber;
            $transactionBank->status = $model->status;
            $transactionBank->triggerId = $model->id;
            $transactionBank->triggerName = 'ถอนเงิน';
            $transactionBank->total = $wallet->total;
            $transactionBank->userId = $model->userId;
            if (!$transactionBank->save()) {
                throw new ServerErrorHttpException();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        Yii::$app->getSession()->setFlash('alert',[
            'body'=> Yii::t('app', 'Waiting for the authorities!!'),
            'options'=> ['class'=>'alert-success']
        ]);
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = WithdrawMoney::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}