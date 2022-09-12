<?php

namespace backend\controllers;

use backend\models\WalletUser;
use GuzzleHttp\Exception\ServerException;
use Yii;
use common\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Bank;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\ServerErrorHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                    'generate' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        Yii::$app->view->title = Yii::t('app', 'User');
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        Yii::$app->view->title = $model->getFullName();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank,'id','name');
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->profileImage = $model->upload($model, 'profileImage');
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                if (!$model->save()) {
                    throw new ServerErrorHttpException(Yii::t('app','Internal Server Error'));
                }
                $wallet = new WalletUser();
                $wallet->userId = $model->id;
                $wallet->total = 0;
                if (!$wallet->save()) {
                    throw new ServerErrorHttpException(Yii::t('app','Internal Server Error'));
                }
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage() . "\n" . $e->getTraceAsString());
        }

        return $this->render('create', [
            'model' => $model,
            'listData' => $listData,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank,'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->profileImage = $model->upload($model,'profileImage');
            $model->setPassword($model->password_hash);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listData' => $listData,
        ]);
    }

    public function actionUpdateStatus($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'updateStatus';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('_formStatus', [
            'model' => $model,
        ]);
    }

    public function actionGenerate($id)
    {
        $model = $this->findModel($id);
        $model->referCode = Yii::$app->security->generateRandomString(6);
        if (!$model->save()) {
            throw new ServerErrorHttpException();
        }
        return $this->redirect(['index']);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        $user->enabled = $user->enabled ? 0 : 1;
        $user->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
