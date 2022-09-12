<?php
namespace backend\controllers;

use Yii;
use backend\models\UserGroup;
use backend\models\UserGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;
use yii\helpers\ArrayHelper;
use backend\models\Group;
use yii\web\ServerErrorHttpException;
use yii\filters\AccessControl;

/**
 * UserGroupController implements the CRUD actions for UserGroup model.
 */
class UserGroupController extends Controller
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
                        'roles' => ['manageSetting'],
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
     * Lists all UserGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserGroup model.
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
     * Creates a new UserGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserGroup();
        $users = User::findAll(['enabled' => true]);
        $listDataUser = ArrayHelper::map($users, 'id', 'fullName');
        $groups = Group::findAll(['enabled' => true]);
        $listDataGroup = ArrayHelper::map($groups, 'id', 'name');
        if ($model->load(Yii::$app->request->post())) {
            $groupId = $model->groupId;
            $users = $model->userId;

            foreach ($users as $userId) {
                $model = new UserGroup();
                $model->userId = $userId;
                $model->groupId = $groupId;
                if (!$model->save()) {
                    throw new ServerErrorHttpException();
                }
                $auth = Yii::$app->authManager;
                $role = $auth->getRole($groupId);
                if ($role) {
                    $auth->assign($role, $userId);
                }
            }
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'listDataUser' => $listDataUser,
            'listDataGroup' => $listDataGroup,
        ]);
    }

    /**
     * Deletes an existing UserGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($model->groupId);
        if ($role) {
            $auth->revoke($role, $model->userId);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserGroup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
