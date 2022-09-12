<?php

namespace backend\controllers;

use backend\models\BillFootball;
use backend\models\BillFootballSearch;
use backend\models\BuyFootball;
use backend\models\MatchFootball;
use backend\models\TransactionBank;
use backend\models\WalletUser;
use Yii;
use backend\models\Leaguefootball;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * LeaguefootballController implements the CRUD actions for Leaguefootball model.
 */
class BillFootballController extends Controller
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
     * Lists all Leaguefootball models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillFootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/layouts/football-tabs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Leaguefootball model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $billFootball = $this->findModel($id);
        $buyId = $billFootball->buyId;
        $model = BuyFootball::findOne($buyId);
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
            $wallet = WalletUser::findOne(['userId' => $model->createdBy]);
            $wallet->total += $model->moneyPlay;
            if (!$wallet->save()) {
                throw new ServerErrorHttpException();
            }
            $transactionBank = new TransactionBank();
            $transactionBank->money = $model->moneyPlay;
            $transactionBank->bankName = $model->user->bank->name;
            $transactionBank->bankNumber = $model->user->numberBank;
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
        $currentUrl = Yii::$app->request->referrer;
        $query_str = parse_url($currentUrl, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        if (isset($query_params['dp-6-page'])) {
            $urlReferrer = Url::to(['/league-football/index',
                'id' => 'bill-football',
                'dp-6-page' => $query_params['dp-6-page']
            ]);
        } else {
            $urlReferrer = Url::to(['/league-football/index', 'id' => 'bill-football']);
        }
        return $this->redirect($urlReferrer);
    }

    /**
     * Finds the Leaguefootball model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leaguefootball the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
