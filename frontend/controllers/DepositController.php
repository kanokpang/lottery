<?php

namespace frontend\controllers;

use backend\models\BankOwner;
use backend\models\ChanelBank;
use backend\models\WalletUser;
use frontend\models\NoteTransferMoney;
use backend\models\TransactionBank;
use backend\models\TransferMoney;
use frontend\models\TransferMoneySearch;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 10/2/2561
 * Time: 8:45
 */

class DepositController extends Controller
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
        ];
    }

    public function actionIndex()
    {
        $searchModel = new TransferMoneySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $user = $this->findUser(Yii::$app->user->id);
        $model = new TransferMoney();
        $noteTransferMoney = new NoteTransferMoney();
        $bankOwner = BankOwner::find()->where(['status' => 1])->all();
        $listBankOwner = ArrayHelper::map($bankOwner, 'id', 'bankName');
        $chanelBanks = ChanelBank::find()->all();
        $listChanelBank = ArrayHelper::map($chanelBanks,'id','name');
        $request = Yii::$app->request;
        if (!$request->isPost) {
            $model->transactionDate = date('Y-m-d H:i:00');
            return $this->render('create', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'user' => $user,
                'noteTransferMoney' => $noteTransferMoney,
                'listChanelBank' => $listChanelBank,
            ]);
        }
        $model->transactionNumber = date("Ymd").'-TF'.rand(1,10000);
        $model->userId = Yii::$app->user->id;
        $model->load($request->post());
        $noteTransferMoney->load(Yii::$app->request->post());
        if (!$model->validate() && !$noteTransferMoney->validate()) {
            return $this->render('create', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'user' => $user,
                'noteTransferMoney' => $noteTransferMoney,
                'listChanelBank' => $listChanelBank,
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            $noteTransferMoney->note = 'รอตรวจสอบการฝากเงิน';
            $noteTransferMoney->idTransferMoney = $model->id;
            $noteTransferMoney->photos = $noteTransferMoney->uploadMultiple($noteTransferMoney, 'photos');
            if (!$noteTransferMoney->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->money;
            $transactionBank->bankName = $model->bankOwner->name;
            $transactionBank->bankNumber = $model->bankOwner->number;
            $transactionBank->status = $model->status;
            $transactionBank->triggerId = $model->id;
            $transactionBank->triggerName = 'ฝากเงิน';
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
        return $this->redirect('index');
    }

    public function actionView($id)
    {
        $model = TransferMoney::findOne(['id' => $id]);
        $noteTransferMoney = NoteTransferMoney::findOne(['idTransferMoney' => $model->id]);
        return $this->render('view',[
            'model' => $model,
            'noteTransferMoney' => $noteTransferMoney
        ]);
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}