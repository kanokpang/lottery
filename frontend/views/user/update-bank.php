<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;

?>
<?= $this->render('left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<div class="profile-content">
    <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <?= Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ]) ?>
    <?php endif; ?>
    <div class="row">
<div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <?= $this->render('tab-x') ?>
                </div>
                <div class="portlet-body">
                    <?php $form = ActiveForm::begin([]); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'bankId')->dropDownList($listData, ['prompt' => Yii::t('app', 'Choose Select')]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'numberBank')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>