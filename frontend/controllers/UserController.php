<?php

namespace frontend\controllers;

use backend\models\Bank;
use backend\models\BuyLottery;
use backend\models\UserGroup;
use backend\models\UserLog;
use backend\models\WalletUser;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 9/2/2561
 * Time: 23:57
 */
class UserController extends Controller
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
        ];
    }

    public function actionProfile($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model = $this->findUser($id);
        $total = $model->findWallet($id);
        $wallet = WalletUser::find()->where(['userId' => Yii::$app->user->id])->one();
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $userLogs = UserLog::find()->where(['userId' => $id])->limit(10)->asArray()->orderBy(['createdAt' => SORT_ASC])->all();
        $buyLottery = BuyLottery::find()->where(['isTrue' => 0])->count();
        return $this->render('profile', [
            'model' => $model,
            'userGroup' => $userGroup,
            'total' => $total,
            'userLogs' => $userLogs,
            'wallet' => $wallet,
            'buyLottery' => $buyLottery
        ]);
    }

    public function actionUpdateProfile($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model = $this->findUser($id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password_hash);
            $model->profileImage = $model->upload($model, 'profileImage');
            $model->save();
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app','Update Profile Successfully'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('update-profile', [
            'model' => $model,
            'userGroup' => $userGroup,
            'listData' => $listData,
        ]);
    }

    public function actionSettingProfile($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model = $this->findUser($id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $render = $this->render('_form-setting', [
            'model' => $model,
        ]);
        return $this->render('profile-setting', [
            'model' => $model,
            'userGroup' => $userGroup,
            'render' => $render
        ]);
    }

    public function actionUpdateImageProfile($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model = $this->findUser($id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->profileImage = $model->upload($model, 'profileImage');
            $model->save();
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app','Update Profile Successfully'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('update-image-profile', [
            'model' => $model,
            'userGroup' => $userGroup,
        ]);
    }

    public function actionUpdatePassword($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model =  $this->findUser($id);
        $model->setScenario('updatePassword');
        $userGroup = UserGroup::find()->where(['userId' => $id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            $user = $this->findUser($id);
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->newPassword);
            $model->save();
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app','Update Profile Successfully'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('update-password', [
            'model' => $model,
            'userGroup' => $userGroup,
        ]);
    }

    public function actionSettingBank($id)
    {
        if (Yii::$app->user->id != $id) {
            throw new ForbiddenHttpException(Yii::t('app', 'You not have permission'));
        }
        $model = $this->findUser($id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $bank = Bank::find()->all();
        $listData = ArrayHelper::map($bank, 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
            $model->save();
            Yii::$app->getSession()->setFlash('alert',[
                'body'=> Yii::t('app','Update Setting Bank Successfully'),
                'options'=>['class'=>'alert-success']
            ]);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('update-bank', [
            'model' => $model,
            'userGroup' => $userGroup,
            'listData' => $listData,
        ]);
    }

    public function actionLog()
    {
        $userLogs = UserLog::find()->where(['userId' => Yii::$app->user->id])->all();
        return $this->render('log', [
            'userLogs' => $userLogs
        ]);
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}