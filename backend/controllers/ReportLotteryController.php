<?php

namespace backend\controllers;

use backend\models\BuyLottery;
use backend\models\BuyLotterySearch;
use backend\models\Lottery;
use backend\models\TypeLottery;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 20/1/2561
 * Time: 14:07
 */
class ReportLotteryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'number'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BuyLotterySearch();
        $dataProviderLotteryPay = $searchModel->search(Yii::$app->request->queryParams, 1);
        $dataProviderLotteryRecive = $searchModel->search(Yii::$app->request->queryParams, 2);
        $lottery = Lottery::find()->all();
        $listData = ArrayHelper::map($lottery, 'id', 'name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'listData' => $listData,
            'dataProviderLotteryRecive' => $dataProviderLotteryRecive,
            'dataProviderLotteryPay' => $dataProviderLotteryPay,
        ]);
    }

    public function actionNumber($lotteryId = null)
    {
        $lotterys = Lottery::find()->where(['status' => 1])->all();
        $listDataLottery = ArrayHelper::map($lotterys, 'id', 'name');
        $buyLotterys = [];
        if ($lotteryId) {
            $buyLotterys = BuyLottery::find()->where(['lotteryId' => $lotteryId])->all();
        } else {
            $lottery = Lottery::find()->where(['status' => 1])->orderBy('id DESC')->limit(1)->one();
            if ($lottery) {
                $buyLotterys = BuyLottery::find()->where(['lotteryId' => $lottery->id])->all();
            }
        }
        $lotteryOrderNumbers = [];
        foreach ($buyLotterys as $key => $buyLottery) {
            $moneyOn = 0;
            $moneyButtom = 0;
            $moneyTodsOn = 0;
            $moneyTodsButtom = 0;
            $keyText = '';
            $typeLottey = $buyLottery->typeLottery->name;
            if (strpos($typeLottey, 'บน')) {
                $moneyOn = $buyLottery->moneyPlay;
                $keyText = 'on';
            }
            if (strpos($typeLottey, 'ล่าง')) {
                $moneyButtom = $buyLottery->moneyPlay;
                $keyText = 'buttom';
            }
            if (strpos($typeLottey, 'บนโต๊ด')) {
                $moneyTodsOn = $buyLottery->moneyPlay;
                $keyText = 'todsOn';
            }
            if (strpos($typeLottey, 'ล่างโต๊ด')) {
                $moneyTodsButtom = $buyLottery->moneyPlay;
                $keyText = 'todsButtom';
            }
            $isExitst = $this->findExists($lotteryOrderNumbers, $buyLottery->number);
            if ($isExitst === false) {
                $lotteryOrderNumbers[] = ['number' => $buyLottery->number, 'on' => $moneyOn, 'buttom' => $moneyButtom, 'todsOn' => $moneyTodsOn, 'todsButtom' => $moneyTodsButtom];
            } else {
                $lotteryOrderNumbers[$isExitst][$keyText] += $buyLottery['moneyPlay'];
            }
        }
        $provider = new ArrayDataProvider([
            'allModels' => $lotteryOrderNumbers,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);
        return $this->render('number', [
            'provider' => $provider,
            'listDataLottery' => $listDataLottery,
            'lotteryId' => $lotteryId
        ]);
    }


    public function findExists($lotteryOrderNumbers, $number)
    {
        foreach ($lotteryOrderNumbers as $index => $lotteryOrderNumber) {
            if ($lotteryOrderNumber['number'] === $number) {
                return $index;
            }
        }
        return false;
    }
}