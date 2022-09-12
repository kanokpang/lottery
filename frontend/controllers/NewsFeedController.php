<?php
namespace  frontend\controllers;

use backend\models\CommentFeedNews;
use backend\models\FeedNews;
use backend\models\UserGroup;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: topte
 * Date: 7/11/2018
 * Time: 5:33 PM
 */

class NewsFeedController extends  Controller
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

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $feedNews = new FeedNews();
        $model = User::findOne(Yii::$app->user->id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();

        if ($feedNews->load(Yii::$app->request->post()) && $feedNews->save()) {
            $feedNews = new FeedNews();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'News Feed Fully'),
                'options' => ['class' => 'alert-success']
            ]);
        }

        return $this->render('index', [
            'model' => $model,
            'userGroup' => $userGroup,
            'feedNews' => $feedNews,
        ]);
    }

    public function actionAll()
    {
        $model = User::findOne(Yii::$app->user->id);
        $userGroup = UserGroup::find()->where(['userId' => $model->id])->one();
        $commentFeedNews = new CommentFeedNews();
        $newsFeeds = FeedNews::find()->all();
        if ($commentFeedNews->load(Yii::$app->request->post()) && $commentFeedNews->validate()) {
            $commentFeedNews->save();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Comment News Feed Success Fully'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->redirect(['all']);
        }
        return $this->render('all', [
            'model' => $model,
            'userGroup' => $userGroup,
            'newsFeeds' => $newsFeeds,
            'commentFeedNews' => $commentFeedNews,
        ]);
    }

    public function actionView($id)
    {
        $newsFeed = FeedNews::findOne($id);
        $commentFeedNewsObjs = CommentFeedNews::findAll(['feedNewsId' => $id]);
        $commentFeedNews = new CommentFeedNews();
        $commentFeedNews->feedNewsId = $id;
        if ($commentFeedNews->load(Yii::$app->request->post()) && $commentFeedNews->validate()) {
            $commentFeedNews->save();
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('app', 'Comment News Feed Success Fully'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->redirect(['view', 'id' => $id]);
        }
        return $this->render('view', [
            'newsFeed' => $newsFeed,
            'commentFeedNewsObjs' => $commentFeedNewsObjs,
            'commentFeedNews' => $commentFeedNews,
        ]);
    }
}