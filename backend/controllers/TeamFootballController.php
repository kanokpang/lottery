<?php

namespace backend\controllers;

use backend\models\Leaguefootball;
use Yii;
use backend\models\TeamFootball;
use backend\models\TeamFootballSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeamFootballController implements the CRUD actions for TeamFootball model.
 */
class TeamFootballController extends Controller
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
     * Lists all TeamFootball models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeamFootballSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TeamFootball model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeamFootball();
        $leagueFootball = Leaguefootball::find()->all();
        $listLeagueFootball = ArrayHelper::map($leagueFootball, 'id','name');
        if ($model->load(Yii::$app->request->post())) {
            $model->logo = $model->upload($model, 'logo');
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'listLeagueFootball' => $listLeagueFootball,
        ]);
    }

    /**
     * Updates an existing TeamFootball model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $leagueFootball = Leaguefootball::find()->all();
        $listLeagueFootball = ArrayHelper::map($leagueFootball, 'id','name');
        if ($model->load(Yii::$app->request->post())) {
            $model->logo = $model->upload($model, 'logo');
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'listLeagueFootball' => $listLeagueFootball,
        ]);
    }

    /**
     * Deletes an existing TeamFootball model.
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
     * Finds the TeamFootball model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeamFootball the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeamFootball::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
