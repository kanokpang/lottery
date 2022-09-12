<?php

namespace backend\controllers;

use backend\models\Group;
use common\models\User;
use backend\models\UserGroup;
use Yii;
use backend\models\WalletUser;
use backend\models\WalletUserSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WalletUserController implements the CRUD actions for WalletUser model.
 */
class WalletUserController extends Controller
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
     * Lists all WalletUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WalletUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'permissionName' => Group::getAdministrator(),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WalletUser model.
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
     * Creates a new WalletUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->can(Group::getAdministrator())) {
            throw new ForbiddenHttpException(Yii::t('app', 'You do not have permission to access'));
        }
        $model = new WalletUser();
        $users = User::find()->where(['status' => User::STATUS_ACTIVE])->all();
        $listData = ArrayHelper::map($users,'id','fullName');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'listData' => $listData,
        ]);
    }

    /**
     * Updates an existing WalletUser model.
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
        $users = User::find()->where(['status' => User::STATUS_ACTIVE])->all();
        $listData = ArrayHelper::map($users,'id','fullName');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listData' => $listData,
        ]);
    }

    /**
     * Deletes an existing WalletUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->user->can(Group::getAdministrator())) {
            throw new ForbiddenHttpException(Yii::t('app', 'You do not have permission to access'));
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WalletUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WalletUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WalletUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
