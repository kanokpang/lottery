<?php

namespace frontend\controllers;

use backend\models\BillFootball;
use backend\models\BuyFootball;
use backend\models\Leaguefootball;
use backend\models\MatchFootball;
use backend\models\TransactionBank;
use backend\models\WalletUser;
use frontend\models\MatchFootballSearch;
use backend\models\TeamFootball;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/12/2018
 * Time: 4:07 PM
 */
class FootballController extends Controller
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
                    'delete-all' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex($id = null, $teamId = null, $rate = null, $type = null)
    {
        $model = new MatchFootball();
        $buyFootball = new BuyFootball();
        if ($id) {
            $selectedTeam = $this->findModel($id);
            $startBuy = $selectedTeam->startBuy;
            $endBuy = $selectedTeam->endBuy;
        }
        $searchModel = new MatchFootballSearch();
        $leagueFootball = Leaguefootball::find()->all();
        $listDataLeagueFootball = ArrayHelper::map($leagueFootball, 'id', 'name');
        $teamFootball = TeamFootball::find()->all();
        $listDataTeamFootball = ArrayHelper::map($teamFootball, 'id', 'name');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('leagueId');
        $request = Yii::$app->request;
        $model->startMatch = date('Y-m-d');
        if ($request->get('MatchFootball')) {
            $model->leagueId = $request->get('MatchFootball')['leagueId'];
            $model->team = $request->get('MatchFootball')['team'];
            $model->startMatch = $request->get('MatchFootball')['startMatch'];
        }
        $request = Yii::$app->request;
        $transaction = \Yii::$app->db->beginTransaction();
        if ($request->post() && isset($startBuy) && isset($endBuy)) {
            $currentDate = date('Y-m-d H:i:s');
            if ($startBuy <= $currentDate && $endBuy >= $currentDate) {
                $buyFootball->matchId = $id;
                if ($teamId === '1') {
                    $buyFootball->teamWinByMatchId = 1;
                } elseif ($teamId === '2') {
                    $buyFootball->teamWinByMatchId = 2;
                } else {
                    $buyFootball->teamWinByMatchId = 3;
                }
                $buyFootball->type = intval($type);
                $rate = intval($rate);
                $buyFootball->isFullTime = $rate === 2 ? 1 : 0;
                if ($buyFootball->type === 1) {
                    if ($buyFootball->teamWinByMatchId === 1) {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->homeFirstTime : $selectedTeam->homeFullTime;
                    } else {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->awayFirstTime : $selectedTeam->awayFullTime;
                    }
                } elseif ($buyFootball->type === 2) {
                    if ($buyFootball->teamWinByMatchId === 1) {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->overFirstTime : $selectedTeam->overFullTime;
                    } else {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->underFirstTime : $selectedTeam->underFullTime;
                    }
                } elseif ($buyFootball->type === 3) {
                    if ($buyFootball->teamWinByMatchId === 1) {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->homeWinFirstTime : $selectedTeam->homeWinFullTime;
                    } elseif ($buyFootball->teamWinByMatchId === 2) {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->awayWinFirstTime : $selectedTeam->awayWinFullTime;
                    } elseif ($buyFootball->teamWinByMatchId === 3) {
                        $buyFootball->rate = $rate === 1 ? $selectedTeam->drawWinFirstTime : $selectedTeam->drawWinFullTime;
                    }
                }
                $buyFootball->load(Yii::$app->request->post());
                if ($buyFootball->validate()) {
                    if (!$buyFootball->save()) {
                        throw new ServerErrorHttpException();
                    }
                    try {
                        $lastIdBill = BillFootball::find()->select(['id'])->orderBy(['id' => SORT_DESC])->limit(1)->one();
                        if ($lastIdBill) {
                            $lastIdBill = $lastIdBill->id + 1;
                        } else {
                            $lastIdBill = 1;
                        }
                        $lastId = str_pad($lastIdBill, 5, '0', STR_PAD_LEFT);
                        $billLottery = new BillFootball();
                        $billLottery->name = 'BLFB' . Yii::$app->formatter->asDate('now', 'yyyyMMdd') . '-' . $lastId;
                        $billLottery->buyId = $buyFootball->id;
                        if (!$billLottery->save()) {
                            throw new ServerErrorHttpException();
                        }
                        $wallet = WalletUser::findOne(['userId' => Yii::$app->user->id]);
                        $wallet->total -= $buyFootball->moneyPlay;
                        if (!$wallet->save()) {
                            throw new ServerErrorHttpException();
                        }
                        $transactionBank = new TransactionBank();
                        $transactionBank->money = $buyFootball->moneyPlay;
                        $transactionBank->bankName = Yii::$app->user->identity->bank->name;
                        $transactionBank->bankNumber = Yii::$app->user->identity->numberBank;
                        $transactionBank->status = 1;
                        $transactionBank->triggerId = Yii::$app->user->id;
                        $transactionBank->triggerName = 'แทงบอล';
                        $transactionBank->userId = $buyFootball->createdBy;
                        $transactionBank->total = $wallet->total;
                        if (!$transactionBank->save()) {
                            throw new ServerErrorHttpException();
                        }
                        $transaction->commit();
                        Yii::$app->getSession()->setFlash('alert', [
                            'body' => Yii::t('app', 'Buy Success Fully'),
                            'options' => ['class' => 'alert-success']
                        ]);
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
                    }
                }
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('app', 'Time Out Again !!') . $selectedTeam->startBuy . '-' . $selectedTeam->endBuy,
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listDataLeagueFootball' => $listDataLeagueFootball,
            'listDataTeamFootball' => $listDataTeamFootball,
            'model' => $model,
            'selectedTeam' => isset($selectedTeam) ? $selectedTeam : null,
            'teamId' => isset($teamId) ? $teamId : null,
            'buyFootball' => $buyFootball,
            'rate' => isset($rate) ? $rate : null,
            'type' => isset($type) ? $type : null,
        ]);
    }

    public function actionBuy($id)
    {
        $buyFootball = BuyFootball::findOne(['matchId' => $id, 'createdBy' => Yii::$app->user->id]);
        if (!$buyFootball) {
            $buyFootball = new BuyFootball();
        }
        $model = $this->findModel($id);
        $buyFootball->matchId = $id;
        if ($buyFootball->load(Yii::$app->request->post()) && $buyFootball->save()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Buy Success Fully'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->redirect(['index']);
        }
        return $this->render('buy', [
            'model' => $model,
            'buyFootball' => $buyFootball,
        ]);
    }

    public function actionResult()
    {
        $model = new MatchFootball();
        $searchModel = new MatchFootballSearch();
        $leagueFootball = Leaguefootball::find()->all();
        $listDataLeagueFootball = ArrayHelper::map($leagueFootball, 'id', 'name');
        $teamFootball = TeamFootball::find()->all();
        $listDataTeamFootball = ArrayHelper::map($teamFootball, 'id', 'name');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy('leagueId');
        $request = Yii::$app->request;
        $model->startMatch = date('Y-m-d');
        if ($request->get('MatchFootball')) {
            $model->leagueId = $request->get('MatchFootball')['leagueId'];
            $model->team = $request->get('MatchFootball')['team'];
            $model->startMatch = $request->get('MatchFootball')['startMatch'];
        }

        return $this->render('result', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'listDataLeagueFootball' => $listDataLeagueFootball,
            'listDataTeamFootball' => $listDataTeamFootball,
            'model' => $model
        ]);
    }


    protected function findModel($id)
    {
        if (($model = MatchFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}