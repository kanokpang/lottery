<?php

namespace frontend\controllers;

use backend\models\BillFootball;
use backend\models\BuyFootball;
use backend\models\MatchFootball;
use backend\models\TransactionBank;
use backend\models\WalletUser;
use Yii;
use backend\models\BillFootballSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * BuyFootballController implements the CRUD actions for BuyFootball model.
 */
class BuyFootballController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all BuyFootball models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillFootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['createdBy' => Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findBillFootball($id);
        if ($model->createdBy !== Yii::$app->user->id) {
            throw new ForbiddenHttpException();
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $billFootball = BillFootball::findOne($id);
        $buyId = $billFootball->buyId;
        $model = $this->findModel($buyId);
        $now = date('Y-m-d');
        $matchFootball = MatchFootball::findOne(['id' => $model->matchId]);
        $now = date('Y-m-d');
        $endDate = date_format(date_create($matchFootball->endBuy), "Y-m-d");
        if ($now >= $endDate) {
            throw new NotFoundHttpException(Yii::t('app','Time out delete. Contact operator'));
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if (!$billFootball->delete()) {
                throw new ServerErrorHttpException();
            }
            if (!$model->delete()) {
                throw new ServerErrorHttpException();
            }
            $wallet = WalletUser::findOne(['userId' => Yii::$app->user->id]);
            $wallet->total += $model->moneyPlay;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->moneyPlay;
            $transactionBank->bankName = Yii::$app->user->identity->bank->name;
            $transactionBank->bankNumber = Yii::$app->user->identity->numberBank;
            $transactionBank->status = 1;
            $transactionBank->triggerId = Yii::$app->user->id;
            $transactionBank->triggerName = 'ยกเลิกรายการแทงบอล';
            $transactionBank->userId = $model->createdBy;
            $transactionBank->total = $wallet->total;
            if (!$transactionBank->save()) {
                throw new ServerErrorHttpException();
            }
            $transaction->commit();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Delete Bill Success Fully'),
                'options' => ['class' => 'alert-success']
            ]);
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = BuyFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findBillFootball($id)
    {
        if (($model = BillFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
