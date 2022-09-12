<?php

namespace backend\controllers;

use backend\models\BillFootballSearch;
use backend\models\BuyFootballSearch;
use backend\models\MatchFootball;
use backend\models\MatchFootballSearch;
use backend\models\ResultFootballSearch;
use backend\models\TeamFootball;
use backend\models\TeamFootballSearch;
use Yii;
use backend\models\Leaguefootball;
use backend\models\LeaguefootballSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LeaguefootballController implements the CRUD actions for Leaguefootball model.
 */
class LeagueFootballController extends Controller
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
        $searchModel = new LeaguefootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $manageMatchSearchModel = new MatchFootballSearch();
        $manageMatchDataProvider = $manageMatchSearchModel->search(Yii::$app->request->queryParams);
        $teamFootballSearchModel = new TeamFootballSearch();
        $teamFootballDataProvider = $teamFootballSearchModel->search(Yii::$app->request->queryParams);
        $buyFootballSearchModel = new BuyFootballSearch();
        $buyFootballDataProvider = $buyFootballSearchModel->search(Yii::$app->request->queryParams);
        $billFootballSearchModel = new BillFootballSearch();
        $billFootballDataProvider = $billFootballSearchModel->search(Yii::$app->request->queryParams);
        $leagueFootball = Leaguefootball::find()->all();
        $listLeagueFootball = ArrayHelper::map($leagueFootball, 'id','name');
        $teamFootball = TeamFootball::find()->all();
        $listTeamFootball = ArrayHelper::map($teamFootball, 'id','name');
        $resultFootballSearch = new ResultFootballSearch();
        $resultFootballDataProvider = $resultFootballSearch->search(Yii::$app->request->queryParams);

        return $this->render('/layouts/football-tabs', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'manageMatchSearchModel' => $manageMatchSearchModel,
            'manageMatchDataProvider' => $manageMatchDataProvider,
            'teamFootballSearchModel' => $teamFootballSearchModel,
            'teamFootballDataProvider' => $teamFootballDataProvider,
            'buyFootballSearchModel' => $buyFootballSearchModel,
            'buyFootballDataProvider' => $buyFootballDataProvider,
            'billFootballSearchModel' => $billFootballSearchModel,
            'billFootballDataProvider' => $billFootballDataProvider,
            'listLeagueFootball' => $listLeagueFootball,
            'listTeamFootball' => $listTeamFootball,
            'resultFootballSearch' => $resultFootballSearch,
            'resultFootballDataProvider' => $resultFootballDataProvider,
        ]);
    }

    /**
     * Creates a new Leaguefootball model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leaguefootball();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Leaguefootball model.
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

    /**
     * Deletes an existing Leaguefootball model.
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
     * Finds the Leaguefootball model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Leaguefootball the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leaguefootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
