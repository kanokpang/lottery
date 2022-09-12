<?php

namespace backend\controllers;

use backend\models\Group;
use backend\models\NoteTransferMoney;
use backend\models\TransactionBank;
use backend\models\User;
use backend\models\UserGroup;
use backend\models\WalletUser;
use backend\models\WithdrawMoney;
use backend\models\WithdrawMoneySearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * WithdrawMoneyController implements the CRUD actions for WithdrawMoney model.
 */
class WithdrawMoneyController extends Controller
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
     * Lists all WithdrawMoney models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WithdrawMoneySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'permissionName' => Group::getAdministrator(),
        ]);
    }

    /**
     * Displays a single WithdrawMoney model.
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
     * Creates a new WithdrawMoney model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WithdrawMoney();
        $request = Yii::$app->request;
        $userGroups = UserGroup::find()->select([UserGroup::tableName().'.userId'])->joinWith(['group'])->where([
            'name' => User::GROUP_NAME_SALE,
            'name' => User::GROUP_NAME_USER])->all();
        $userIds = [];
        foreach ($userGroups as $userGroup) {
            $userIds[] = $userGroup->userId;
        }
        $users = User::findAll(['id' => $userIds, 'status' => \common\models\User::STATUS_ACTIVE]);
        $listData = ArrayHelper::map($users, 'id','fullName');
        if (!$request->isPost) {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData,
            ]);
        }

        $model->load($request->post());
        $user = User::findOne(['id' => $model->userId]);
        $model->bankNumber = $user->numberBank;
        $model->bankName = $user->bank->name;
        $model->transactionNumber = date("Ymd").'-WD'.rand(1,10000);
        $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
        if (!$model->validate()) {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData,
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
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
        return $this->redirect(['index']);
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        if (!$request->post() || !$request->post()["WithdrawMoney"]["detail"]) {
            return $this->render('_form-detail',[
                'model' => $model
            ]);
        }
        $model->status = 2;
        $transaction = Yii::$app->db->beginTransaction();
        $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
        try {
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            $wallet->total += $model->money;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->money;
            $transactionBank->bankName = $model->bankName;
            $transactionBank->bankNumber = $model->bankNumber;
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
     * Updates an existing WithdrawMoney model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!Yii::$app->user->can(Group::getAdministrator())) {
            throw new ForbiddenHttpException(Yii::t('app', 'You do not have permission to access'));
        }
        $model = $this->findModel($id);
        $request = Yii::$app->request;
        $userGroups = UserGroup::find()->select([UserGroup::tableName().'.userId'])->joinWith(['group'])->where([
            'name' => User::GROUP_NAME_SALE,
            'name' => User::GROUP_NAME_USER])->all();
        $userIds = [];
        foreach ($userGroups as $userGroup) {
            $userIds[] = $userGroup->userId;
        }
        $users = User::findAll(['id' => $userIds, 'status' => \common\models\User::STATUS_ACTIVE]);
        $listData = ArrayHelper::map($users, 'id','fullName');
        if (!$request->isPost) {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData,
            ]);
        }

        $model->load($request->post());
        $user = User::findOne(['id' => $model->userId]);
        $model->bankNumber = $user->numberBank;
        $model->bankName = $user->bank->name;
        $wallet = WalletUser::find()->where(['userId' => $model->userId])->one();
        if (!$model->validate()) {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData,
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save()) {
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
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionComplete($id)
    {
        if (!Yii::$app->user->can(Group::getAdministrator())) {
            throw new ForbiddenHttpException(Yii::t('app', 'You do not have permission to access'));
        }
        $model = $this->findModel($id);
        $model->status = 1;
        $transaction = Yii::$app->db->beginTransaction();
        $wallet = WalletUser::findOne(['userId' => $model->userId]);
        if ($model->money > $wallet->total) {
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app', 'Please check the balance. !!'),
                'options'=> ['class'=>'alert-danger']
            ]);
            return $this->redirect(['index']);
        }
        try {
            if (!$model->save()) {
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
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app', 'Successfully.'),
                'options'=> ['class'=>'alert-success']
            ]);
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing WithdrawMoney model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the WithdrawMoney model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WithdrawMoney the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WithdrawMoney::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
