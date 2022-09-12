<?php
use kartik\grid\GridView;
use yii\helpers\Html;

?>
<div class="portlet light portlet-fit ">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-red bold uppercase"><?= $lottery->name; ?></span>
            <span class="caption-helper">( <?= $promotion->name ?> )</span>
        </div>
        <div class="actions hidden-print">
            <a class="btn btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title=""
               title=""> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="m-heading-1 border-green m-bordered text-center server-timeout">
            <h3 class="font-blue-steel">
                <?= $lottery->name; ?>
            </h3>
            <p class="font-red-mint font-lg p-countdown">
                <span id="countdown" data-countdown="" class="font-red-mint">ปิดรับ: <?= $lottery->endDateTime ?></span>
            </p>
        </div>
        <div class="mt-element-step">
            <div class="row step-thin">
                <div class="col-md-4 bg-grey mt-step-col ">
                    <div class="mt-step-number bg-white font-grey">1</div>
                    <div class="mt-step-title uppercase font-grey-cascade">ราคา</div>
                    <div class="mt-step-content font-grey-cascade">เลือกแผนเราคา</div>
                </div>
                <div class=" col-md-4  bg-grey mt-step-col  active ">
                    <div class="mt-step-number bg-white font-grey"> 2</div>
                    <div class="mt-step-title uppercase font-grey-cascade">เลขหวย</div>
                    <div class="mt-step-content font-grey-cascade">ระบุเลขที่จะแทงและจ่ายเงิน</div>
                </div>
                <div class=" col-md-4  bg-grey  mt-step-col ">
                    <div class="mt-step-number bg-white font-grey"> 3</div>
                    <div class="mt-step-title uppercase font-grey-cascade">ใบสั่งซื้อ</div>
                    <div class="mt-step-content font-grey-cascade">สรุปใบสั่งซื้อ
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
            </div>
            <div class="col-md-4">
                <div class="portlet box green-meadow">
                    <div class="portlet-title">
                        <div class="caption">เลือกเลข</div>
                    </div>
                    <div class="portlet-body">
                      <?= $this->render('_form',[
                          'model' => $model,
                          'listData' => $listData,
                      ])?>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h3 align="center"><?= $promotion->name ?></h3>
                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption">ตารางเลข</div>
                    </div>
                    <div class="portlet-body ">
                        <div class="table-responsive">
                            <?= GridView::widget([
                                'id' => 'grid-recive',
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                // set export properties
                                'export' => false,
                                'panel' => false,
                                'showPageSummary' => true,
                                'columns' => [
                                    ['class' => 'kartik\grid\SerialColumn'],

                                    [
                                        'attribute' => 'typeLottery.name',
                                        'label' => Yii::t('app','Type Lottery'),
                                        'pageSummary' => Yii::t('app', 'Total'),
                                    ],
                                    [
                                        'attribute' => 'number',
                                    ],
                                    [
                                        'label' => Yii::t('app','Money Play'),
                                        'attribute' => 'moneyPlay',
                                        'format' => ['decimal', 2],
                                        'pageSummary' => true
                                    ],
                                    [
                                        'label' => Yii::t('app','Money Payment'),
                                        'attribute' => 'moneyPay',
                                        'format' => ['decimal', 2],
                                        'pageSummary' => true,
                                        'pageSummaryFunc' => GridView::F_SUM,
                                    ],
                                    [
                                        'header' => '',
                                        'class' => 'kartik\grid\ActionColumn',
                                        'template' => '<div class="btn-group btn-group-sm text-center" role="group">{delete}</div>',
                                        'buttonOptions' => ['class' => 'btn btn-default'],
                                    ],
                                ],
                               // 'showFooter' => true,
                            ]); ?>
                        </div>
                        <?= Html::a(Yii::t('app','Buy'), ['lottery/buy', 'id' => $lotteryId], ['class'=>'btn blue-chambray mt-ladda-btn ladda-button']) ?>
                        <?= Html::a(Yii::t('app','Clear Lists'), ['lottery/delete-all', 'lotteryId' => $lotteryId], ['class'=>'btn red-sunglo',  'data' => [
                            'confirm' => Yii::t('app','Are you sure you want to delete all?'),
                            'method' => 'post',
                        ]]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>