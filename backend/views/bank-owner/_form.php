<?php

use kartik\switchinput\SwitchInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WinLottery */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
    $("#dynamic-form").data("yiiActiveForm").attributes
        jQuery(this).html("Bank Owner: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Bank Owner: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="bank-owner">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><?= Yii::t('app', 'Bank Owner') ?></h4></div>
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
                    'accountName',
                    'name',
                    'number',
                    'status',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php
                $i = 0;
                foreach ($models as $i => $model): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">Bank Owner: <?= ($i + 1) ?></span>
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
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]code")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]accountName")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]number")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($model, "[{$i}]status")->dropDownList([
                                        '1' => Yii::t('app', 'Active'),
                                        '0' => Yii::t('app', 'In Active')]) ?>
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
