<?php

use kartik\datetime\DateTimePicker;
use kartik\widgets\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchFootball */
/* @var $form yii\widgets\ActiveForm */
?>
    <h2><?= $this->title; ?></h2>
<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'leagueId')->dropDownList($listDataLeague,
                ['id '=> 'league-id', 'prompt' => Yii::t('app', 'Select League')]
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'teamId1')->widget(DepDrop::classname(), [
                'options' => ['id' => 'team-id1'],
                'data' => $teamId,
                'pluginOptions' => [
                    'depends' => ['matchfootball-leagueid'],
                    'placeholder' => Yii::t('app', 'Select Team'),
                    'url' => Url::to(['/match-football/get-team'])
                ]
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'teamId2')->widget(DepDrop::classname(), [
                'options' => ['id' => 'team-id2'],
                'data' => $teamId,
                'pluginOptions' => [
                    'depends' => ['matchfootball-leagueid'],
                    'placeholder' => Yii::t('app', 'Select Team'),
                    'url' => Url::to(['/match-football/get-team'])
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'startMatch')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Select start match')],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'php:Y-m-d H:i:00',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'endMatch')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Select end match')],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'php:Y-m-d H:i:00',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'startBuy')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Select start match')],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'php:Y-m-d H:i:00',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'endBuy')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Select end match')],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'php:Y-m-d H:i:00',
                    'todayHighlight' => true
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, "isSecondTeam")->radioList([1 => Yii::t('app', 'Team Home'), 2 => Yii::t('app','Team Away')]) ?>
        </div>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>
        <div class="col-md-12">
            <h3><?= Yii::t('app', 'First Time Match Football') ?></h3>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "hdpFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "homeFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "awayFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "rangeOverFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "goalFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "overFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "underFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "homeWinFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "awayWinFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "drawWinFirstTime")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "isFullTime")->radioList([1 => Yii::t('app', 'Full Time')], ['onclick' => "isFullTime()"])
            ?>
        </div>
        <div id="fullTime" hidden>
            <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>
            <div class="col-md-12">
                <h3><?= Yii::t('app', 'Second Time Match Football') ?></h3>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "hdpFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "homeFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "awayFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "goalFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "rangeOverFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "overFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "underFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "homeWinFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "awayWinFullTime")->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, "drawWinFullTime")->textInput(['maxlength' => true]) ?>
            </div>
        </div>


        <div class="form-group col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
    <script>
        function isFullTime() {
            var selected = $("input[type='radio'][name='MatchFootball[isFullTime]']:checked");
            if (selected.length > 0) {
                $('#fullTime').show();
            }
        }
    </script>
<?php
$js = <<<EOT
 var selected = $("input[type='radio'][name='MatchFootball[isFullTime]']:checked");
        if (selected.length > 0) {
            $('#fullTime').show();
        }
EOT;
$this->registerJs($js);
?>