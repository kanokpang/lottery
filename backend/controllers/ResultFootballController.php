<?php

namespace backend\controllers;

use backend\models\BuyFootball;
use backend\models\ResultFootball;
use backend\models\ResultFootballSearch;
use backend\models\TransactionBank;
use backend\models\TransferMoney;
use backend\models\WalletUser;
use backend\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 7/21/2018
 * Time: 11:18 AM
 */

class ResultFootballController extends Controller
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
                    'answer' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ResultFootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAnswer($id)
    {
        $model = $this->findModel($id);
        if ($model->isAnswer) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Can not Answer'),
                'options' => ['class' => 'alert-danger']
            ]);
        }
        $buyFootballs = BuyFootball::find()->where([
            'matchId' => $model->matchId,
            'type' => $model->type,
            'isFullTime' => $model->isFullTime,
        ])->all();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model->setScenario('answer');
            $model->isAnswer = 1;
            if (!$model->save()) {
                throw new ServerErrorHttpException();
            }
            foreach ($buyFootballs as $buyFootball) {
                $buyFootball->setScenario('answer');
                if (intval($model->teamWinByMatchId) === intval($buyFootball->teamWinByMatchId)) {
                    $buyFootball->isTrue = 1;
                } else {
                    $buyFootball->isTrue = 2;
                }
                if (!$buyFootball->save()) {
                    throw new ServerErrorHttpException();
                }
                if ($buyFootball->isTrue === 1) {
                    $totalMoneyPlay = $buyFootball->moneyPlay * $buyFootball->rate;
                    $tranferMoney = new TransferMoney();
                    $tranferMoney->transactionNumber = date("Ymd") . '-FB' . rand(1, 10000);
                    $tranferMoney->userId = $buyFootball->createdBy;
                    $tranferMoney->money = $totalMoneyPlay;
                    $tranferMoney->status = 1;
                    $user = User::findOne(['id' => $buyFootball->createdBy]);
                    $tranferMoney->bankOwnerId = $user->bankId;
                    if (!$tranferMoney->save(false)) {
                        throw new ServerErrorHttpException();
                    }
                    $walletUser = WalletUser::findOne(['userId' => $user->id]);
                    $walletUser->total += $tranferMoney->money;
                    if (!$walletUser->save()) {
                        throw new ServerErrorHttpException();
                    }
                    $transactionBank = new TransactionBank();
                    $transactionBank->money = $totalMoneyPlay;
                    $transactionBank->bankName = $user->bank->name;
                    $transactionBank->bankNumber = $user->numberBank;
                    $transactionBank->status = $tranferMoney->status;
                    $transactionBank->triggerId = $tranferMoney->id;
                    $transactionBank->triggerName = 'ชนะการแทงบอล';
                    $transactionBank->userId = $user->id;
                    $transactionBank->total = $walletUser->total;
                    if (!$transactionBank->save(false)) {
                        throw new ServerErrorHttpException();
                    }
                }
            }
            $transaction->commit();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Answer Success Fully'),
                'options' => ['class' => 'alert-success']
            ]);
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $this->redirect(['/league-football/index']);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->isAnswer) {
            $model->delete();
        }

        return $this->redirect(['/league-football/index']);
    }

    protected function findModel($id)
    {
        if (($model = ResultFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}