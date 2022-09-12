<?php

namespace backend\controllers;

use backend\models\BankOwner;
use backend\models\ChanelBank;
use backend\models\Group;
use backend\models\NoteTransferMoney;
use backend\models\TransactionBank;
use backend\models\TransferMoney;
use backend\models\TransferMoneySearch;
use backend\models\User;
use backend\models\UserGroup;
use backend\models\WalletUser;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * TransferMoneyController implements the CRUD actions for TransferMoney model.
 */
class TransferMoneyController extends Controller
{
    const GROUP_NAME_ADMINISTRATOR = 'Administrator';

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
     * Lists all TransferMoney models.
     * @return mixed
     */
    public function actionIndex()
    {
        $group = Group::find()->where(['name' => self::GROUP_NAME_ADMINISTRATOR])->one();
        $permissionName = $group->id;
        $searchModel = new TransferMoneySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $bankOwner = BankOwner::find()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'permissionName' => $permissionName,
            'bankOwner' => $bankOwner
        ]);
    }

    /**
     * Displays a single TransferMoney model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $noteTransferMoney = NoteTransferMoney::findOne(['idTransferMoney' => $model->id]);
        if (!$noteTransferMoney) {
            $noteTransferMoney = new NoteTransferMoney();
        }

        if ($noteTransferMoney->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $noteTransferMoney->idTransferMoney = $id;
            $noteTransferMoney->photos = $noteTransferMoney->uploadMultiple($noteTransferMoney, 'photos');
            if (intval($model->status) === 1 || intval($model->status) === 2) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (!$model->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $wallet = WalletUser::findOne(['userId' => $model->userId]);
                    $wallet->total += $model->money;
                    if (!$wallet->save()) {
                        throw new ServerErrorHttpException();
                    }
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
                    if (!$noteTransferMoney->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $transaction->commit();
                    return $this->redirect(['index']);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            } else {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (!$model->save()) {
                        throw new ServerErrorHttpException();
                    }
                    if (!$noteTransferMoney->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $transaction->commit();
                    return $this->redirect(['index']);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        return $this->render('view', [
            'model' => $model,
            'noteTransferMoney' => $noteTransferMoney
        ]);
    }

    /**
     * Creates a new TransferMoney model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TransferMoney();
        $chanelBank = ChanelBank::find()->all();
        $listChanelBank = ArrayHelper::map($chanelBank, 'id', 'name');
        $bankOwner = BankOwner::find()->all();
        $listBankOwner = ArrayHelper::map($bankOwner, 'id', 'bankName');
        $userGroups = UserGroup::find()->select([UserGroup::tableName().'.userId'])->joinWith(['group'])->where([
            'name' => User::GROUP_NAME_SALE,
            'name' => User::GROUP_NAME_USER])->all();
        $userIds = [];
        foreach ($userGroups as $userGroup) {
            $userIds[] = $userGroup->userId;
        }
        $users = User::findAll(['id' => $userIds, 'status' => \common\models\User::STATUS_ACTIVE]);
        $listDataUser = ArrayHelper::map($users, 'id','fullName');
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('create', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'listChanelBank' => $listChanelBank,
                'listDataUser' => $listDataUser,
            ]);
        }
        $model->transactionNumber = date("Ymd").'-TF'.rand(1,10000);
        $model->load($request->post());
        if (!$model->validate()) {
            return $this->render('create', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'listChanelBank' => $listChanelBank,
                'listDataUser' => $listDataUser
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
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
            $transactionBank->userId = $model->userId;
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

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Updates an existing TransferMoney model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $group = Group::find()->where(['name' => self::GROUP_NAME_ADMINISTRATOR])->one();
        $permissionName = $group->id;
        if (!Yii::$app->user->can($permissionName)) {
            throw new ForbiddenHttpException(Yii::t('app', 'You do not have permission to access'));
        }
        $model = $this->findModel($id);
        $bankOwner = BankOwner::find()->all();
        $listBankOwner = ArrayHelper::map($bankOwner, 'id', 'bankName');
        $chanelBank = ChanelBank::find()->all();
        $listChanelBank = ArrayHelper::map($chanelBank, 'id', 'name');
        $request = Yii::$app->request;
        if (!$request->isPost) {
            return $this->render('update', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'permissionName' => $permissionName,
                'listChanelBank' => $listChanelBank,
            ]);
        }

        $model->load($request->post());
        if (!$model->validate()) {
            return $this->render('update', [
                'model' => $model,
                'listBankOwner' => $listBankOwner,
                'permissionName' => $permissionName,
                'listChanelBank' => $listChanelBank,
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
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
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Deletes an existing TransferMoney model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionComplete($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::findOne(['userId' => $model->userId]);
            $wallet->total += $model->money;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->money;
            $transactionBank->bankName = $model->bankOwner->name;
            $transactionBank->bankNumber = $model->bankOwner->number;
            $transactionBank->status = $model->status;
            $transactionBank->triggerId = $model->id;
            $transactionBank->triggerName = 'ฝากเงิน';
            $transactionBank->total = $wallet->total;
            $transactionBank->userId = $model->id;
            if (!$transactionBank->save()) {
                throw new ServerErrorHttpException();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $this->redirect(['index']);
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->money;
            $transactionBank->bankName = $model->bankOwner->name;
            $transactionBank->bankNumber = $model->bankOwner->number;
            $transactionBank->status = $model->status;
            $transactionBank->triggerId = $model->id;
            $transactionBank->triggerName = 'Cancel';
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
        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $noteTransferMoney = NoteTransferMoney::findOne($id);
        $photos = $noteTransferMoney->photos ? @explode(',', $noteTransferMoney->photos) : [];
        foreach ($photos as $photo) {
            $images = $noteTransferMoney->getUploadPath() . $photo;
            if (!unlink($images)) {
                throw new ServerErrorHttpException("Couldn't delete the file");
            }
        }
        $noteTransferMoney->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TransferMoney model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TransferMoney the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TransferMoney::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
