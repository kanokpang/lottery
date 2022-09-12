<?php

namespace backend\controllers;

use backend\models\Leaguefootball;
use backend\models\ResultFootball;
use backend\models\TeamFootball;
use Yii;
use backend\models\MatchFootball;
use backend\models\MatchFootballSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ServerErrorHttpException;

/**
 * MatchFootballController implements the CRUD actions for MatchFootball model.
 */
class MatchFootballController extends Controller
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
     * Lists all MatchFootball models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatchFootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatchFootball model.
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
     * Creates a new MatchFootball model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatchFootball();
        $league = Leaguefootball::find()->all();
        $listDataLeague = ArrayHelper::map($league, 'id', 'name');
        $team = TeamFootball::find()->all();
        $listDataTeam = ArrayHelper::map($team, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'listDataLeague' => $listDataLeague,
            'listDataTeam' => $listDataTeam
        ]);
    }

    /**
     * Updates an existing MatchFootball model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $teamId = ArrayHelper::map($this->getTeam($model->leagueId),'id','name');
        $league = Leaguefootball::find()->all();
        $listDataLeague = ArrayHelper::map($league, 'id', 'name');
        $team = TeamFootball::find()->all();
        $listDataTeam = ArrayHelper::map($team, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listDataLeague' => $listDataLeague,
            'listDataTeam' => $listDataTeam,
            'teamId' => $teamId,
        ]);
    }

    public function actionScore($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('score');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['index']);
		}
        return $this->render('score', [
            'model' => $model
        ]);
    }
	
	public function actionResult($id)
	{
	    $resultFootball = new ResultFootball();
		$model = $this->findModel($id);
		$request = Yii::$app->request;
        $transaction = Yii::$app->db->beginTransaction();
		if ($request->post()) {
		    $resultFootball->matchId = $id;
            if ($resultFootball->load($request->post()) && $resultFootball->validate()) {
                try {
                    $types = $resultFootball->type;
                    foreach ($types as $type) {
                        $resultFootballNew = new ResultFootball();
                        $resultFootballNew->type = intval($type);
                        $resultFootballNew->isFullTime = $resultFootball->isFullTime;
                        $resultFootballNew->matchId = $resultFootball->matchId;
                        $resultFootballNew->teamWinByMatchId = $resultFootball->teamWinByMatchId;
                        if (!$resultFootballNew->save()) {
                            throw new ServerErrorHttpException();
                        }
                    }
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t('app', 'Success Fully'),
                        'options' => ['class' => 'alert-success']
                    ]);
                    return $this->redirect(['index']);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
		return $this->render('result', [
		    'model' => $model,
            'resultFootball' => $resultFootball
        ]);
	}

    /**
     * Deletes an existing MatchFootball model.
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


    public function actionGetTeam()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $leagueId = $parents[0];
                $out = $this->getTeam($leagueId);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getTeam($id)
    {
        $datas = TeamFootball::find()->where(['leagueId' => $id])->all();
        return $this->MapData($datas, 'id', 'name');
    }


    /**
     * Finds the MatchFootball model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MatchFootball the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatchFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function isAnswer($id)
    {
        $isAnswer = ResultFootball::find()->where(['matchId' => $id])->count();
        return $isAnswer;
    }

    protected function MapData($datas,$fieldId,$fieldName)
    {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }
}
