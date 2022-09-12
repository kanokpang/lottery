<?php

namespace backend\controllers;

use backend\models\BuyLottery;
use backend\models\Group;
use backend\models\UserGroup;
use kartik\mpdf\Pdf;
use Yii;
use backend\models\BillLottery;
use backend\models\BillLotterySearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BillLotteryController implements the CRUD actions for BillLottery model.
 */
class BillLotteryController extends Controller
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
     * Lists all BillLottery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillLotterySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BillLottery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $idBuyLotterys = explode(',', $model->idBuyLottery);
        $query = BuyLottery::find()->where(['id' => $idBuyLotterys]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $totalMoneyPlay = 0;
        $totalMoneyPay = 0;
        $buyLotterys = $query->asArray()->all();
        foreach ($buyLotterys as $buyLottery) {
            $totalMoneyPlay += $buyLottery['moneyPlay'];
            $totalMoneyPay += $buyLottery['moneyPay'];
        }

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'totalMoneyPlay' => $totalMoneyPlay,
            'totalMoneyPay' => $totalMoneyPay,
            'buyLotterys' => $buyLotterys,
        ]);
    }

    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        $userGroup = UserGroup::findOne(['userId' => $model->buyLottery->userId]);
        $group = Group::find()->where(['id' => $userGroup->groupId])->one();
        $idBuyLotterys = explode(',', $model->idBuyLottery);
        $buyLottery = BuyLottery::find()->where([
            'id' => $idBuyLotterys,
        ])->all();
        if (!$buyLottery) {
            Yii::$app->getSession()->setFlash('alert',[
                'body'=>'ไม่พบข้อมูล !!',
                'options'=>['class'=>'alert-warning']
            ]);
            return $this->redirect('index');
        }
        // get your HTML raw content without any layouts or scripts
        $content = $this->renderPartial('_report', [
            'model' => $model,
            'buyLottery' => $buyLottery,
            'group' => $group,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            // A4 paper format
            'format' => [80, 80],
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@backend/web/css/pdf.css',
            // any css to be embedded if required
            'cssInline' => '.bd{border:1.5px solid; text-align: center;} .ar{text-align:right} .imgbd{border:1px solid}',
            // set mPDF properties on the fly
            'options' => ['title' => 'Preview Report Lottery'],
            // call mPDF methods on the fly
            'methods' => [
                //'SetHeader'=>[''],
                //'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
    }


    /**
     * Finds the BillLottery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BillLottery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillLottery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
