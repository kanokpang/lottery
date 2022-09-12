<?php

use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BuyLotterySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Number By Lottery');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<div class="row">
    <div class="col-md-12">
        <?php
        ActiveForm::begin([
            'method' => 'GET',
            'action' => Url::to(['number']),
        ]);
        ?>
        <div class="col-md-offset-3 col-md-4">
            <?php
            echo '<label class="control-label">' . Yii::t('app', 'Select Lottery') . '</label> ';
            echo Select2::widget([
                'name' => 'lotteryId',
                'data' => $listDataLottery,
                'value' => $lotteryId,
                'language' => 'th',
                'options' => ['placeholder' => Yii::t('app', 'Select Lottery')],
            ]);
            ?>
        </div>
        <div class="col-md-4" style="margin-top: 20px;">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary', 'style' => 'margin: 5px;']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <?php
            echo GridView::widget([
                'id' => 'grid-recive',
                'dataProvider' => $provider,
                'toolbar' => [
                    ['content' => ''],
                    '{export}',
                    '{toggleData}',
                ],
                // set export properties
                'export' => [
                    'fontAwesome' => true
                ],
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                ],
                'showPageSummary' => true,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    [
                        'attribute' => 'number',
                    ],
                    [
                        'label' => Yii::t('app', 'On'),
                        'attribute' => 'on',
                        'pageSummary' => true
                    ],
                    [
                        'label' => Yii::t('app', 'Buttom'),
                        'attribute' => 'buttom',
                        'pageSummary' => true
                    ],
                    [
                        'label' => Yii::t('app', 'Tods On'),
                        'attribute' => 'todsOn',
                        'pageSummary' => true
                    ],
                    [
                        'label' => Yii::t('app', 'Tods Buttom'),
                        'attribute' => 'todsButtom',
                        'pageSummary' => true
                    ],
                ],
                //'showFooter' => true,
            ]); ?>
        </div>
    </div>
</div>