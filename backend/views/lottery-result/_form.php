<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WinLottery */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Win Lottery: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Win Lottery: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="win-lottery-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><?= Yii::t('app', 'Win Lottery') ?></h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $models[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'lotteryId',
                    'typeLotteryId',
                    'number',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php
                $i = 0;
                foreach ($models as $i => $model):?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">Win Lottery: <?= ($i + 1) ?></span>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i
                                            class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i
                                            class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$model->isNewRecord) {
                                echo Html::activeHiddenInput($model, "[{$i}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <?= $form->field($model, "[{$i}]lotteryId")->dropDownList($listDataLottery, ['prompt' => Yii::t('app', 'Select Lottery')]) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, "[{$i}]typeLotteryId")->dropDownList($listDataTypeLottery,
                                        [
                                            'prompt' => Yii::t('app', 'Select Type Lottery'),
                                        ]) ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, "[{$i}]number")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-4 lottery">
                                    <?= $form->field($model, "[{$i}]treeDigitTod")->radioList([
                                        1 => Yii::t('app', 'Enabled'),
                                    ])->hint('<span style="color:red;">(ใช้สำหรับประเภท lottery ที่เป็นตัวล่างโต๊ดเท่านั้น)</span>') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
