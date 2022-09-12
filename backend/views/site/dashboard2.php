<?php

/* @var $this yii\web\View */

use kartik\date\DatePicker;
use daixianceng\echarts\ECharts;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->registerCssFile('@web/css/adminLTE.min.css');
$this->registerCssFile('@web/css/ionicons.min.css');
$this->title = Yii::t('app', 'Dashboard 2');
?>
<div class="site-index">
    <h2><?= $this->title; ?></h2>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $totalVisitor ?></h3>
                <p><?= Yii::t('app', 'Total Visitor') ?></p>
            </div>
            <div class="icon" style="top: -43px !important;">
                <i class="fa fa-street-view" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $countIssue ?></h3>

                <p><?= Yii::t('app', 'Total Issue') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-question-circle-o" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= number_format($sumWithDrawMoney->money, 2) ?></h3>

                <p><?= Yii::t('app', 'Total Sum Withdraw Money') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-usd" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3><?= number_format($sumTransferMoney->money, 2) ?></h3>

                <p><?= Yii::t('app', 'Total Sum Transfer Money') ?></p>
            </div>
            <div class="icon" style="top: -43px;">
                <i class="fa fa-refresh" style="font-size: 60px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-12">
        <?php
        ActiveForm::begin([
            'method' => 'GET',
            'action' => Url::to(['dashboard2']),
        ]);
        ?>
        <div class="col-md-2">
            <?php
            echo '<label class="control-label">' . Yii::t('app', 'Select Start Date') . '</label> ';
            echo DatePicker::widget([
                'name' => 'date',
                'value' => $date,
                'removeButton' => false,
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div id="endDate" class="col-md-2" hidden>
            <?php
            echo '<label class="control-label">' . Yii::t('app', 'Select End Date') . '</label> ';
            echo DatePicker::widget([
                'name' => 'endDate',
                'value' => Yii::$app->formatter->asDate($endDate, 'php:Y-m-d'),
                'removeButton' => false,
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
        <div class="col-md-5">
            <label class="control-label"><?= Yii::t('app', 'Display By') ?></label>
            <div class="form-control">
                <label>
                    <input type="radio" name="type"
                           onchange="$('#endDate').show()" value="etc" <?= ($type === 'etc') ? 'checked' : '' ?>> <?= Yii::t('app', 'From/To'); ?>
                </label>
                <label>
                    <input type="radio" name="type" onchange="$('#endDate').hide()" value="day" <?= ($type === 'day') ? 'checked' : '' ?>>
                    <?= Yii::t('app', 'Hr/Day'); ?>
                </label>
                <label>
                    <input type="radio" name="type" onchange="$('#endDate').hide()" value="week" <?= ($type === 'week') ? 'checked' : '' ?>>
                    <?= Yii::t('app', 'Week'); ?>
                </label>
                <label>
                    <input type="radio" name="type"
                           onchange="$('#endDate').hide()" value="month" <?= ($type === 'month') ? 'checked' : '' ?>> <?= Yii::t('app', 'Month'); ?>
                </label>
                <label>
                    <input type="radio" name="type"
                          onchange="$('#endDate').hide()" value="year" <?= ($type === 'year') ? 'checked' : '' ?>> <?= Yii::t('app', 'Year'); ?>
                </label>
            </div>
        </div>
        <div class="col-md-2" style="margin-top: 20px;">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary', 'style' => 'margin: 5px;']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Highcharts::widget([
                'options' => [
                    'chart' => ['type' => 'column'],
                    'title' => ['text' => Yii::t('app', 'Information Sale Bill Lottery')],
                    'xAxis' => [
                        'categories' => array_keys($reportDataUserNormal)
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'จำนวนเงินที่ขายได้']
                    ],
                    'series' => [
                        ['name' => 'User Normal', 'data' => array_values($reportDataUserNormal)],
                        ['name' => 'User Sale', 'data' => array_values($reportDataUserSale)]
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>
<?php
$js = <<<EOT
var type = $('input[name=type]:checked').val();
if (type === 'etc') {
    $('#endDate').show();
}
EOT;
$this->registerJs($js);
?>
