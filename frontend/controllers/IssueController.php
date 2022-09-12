<?php

namespace frontend\controllers;

use backend\models\AnswerIssue;
use backend\models\Issue;
use backend\models\UserGroup;
use common\models\User;
use Yii;
use backend\models\IssueSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 25/3/2561
 * Time: 21:57
 */
class IssueController extends Controller
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
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = $this->findUser(Yii::$app->user->id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $issues = Issue::find()->where(['createdBy' => $model->id])->all();

        return $this->render('index', [
            'model' => $model,
            'userGroup' => $userGroup,
            'issues' => $issues,
        ]);
    }

    public function actionCreate()
    {
        $model = new Issue();
        $user = $this->findUser(Yii::$app->user->id);
        $userGroup = UserGroup::find()->where(['userId' => $user->id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'user' => $user,
            'userGroup' => $userGroup,
        ]);
    }

    public function actionView($id)
    {
        $answerIssue = new AnswerIssue();
        $answerDescription = AnswerIssue::findAll(['issueId' => $id]);
        $request = Yii::$app->request;
        if ($request->isPost) {
            $answerIssue->issueId = $id;
            if ($answerIssue->load($request->post()) && $answerIssue->save()) {
                return $this->redirect(['view', 'id' => $answerIssue->issueId]);
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'answerIssue' => $answerIssue,
            'answerDescription' => $answerDescription,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = $this->findUser(Yii::$app->user->id);
        $userGroup = UserGroup::find()->where(['userId' => $user->id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'user' => $user,
            'userGroup' => $userGroup,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->status) {
            $model->status = 0;
        } else {
            $model->status = 1;
        }
        $model->save();

        return $this->redirect(['index']);
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel($id)
    {
        if (($model = Issue::findOne([
                    'id' => $id,
                    'createdBy' => Yii::$app->user->id]
            )) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}