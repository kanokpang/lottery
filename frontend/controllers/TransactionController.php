<?php
namespace frontend\controllers;

use frontend\models\TransactionBankSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 31/3/2561
 * Time: 14:28
 */

class TransactionController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new TransactionBankSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where([
            'status' => 1,
        ])->andWhere(['or', ['triggerName' => 'ถอนเงิน'], ['triggerName' => 'ฝากเงิน']]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}