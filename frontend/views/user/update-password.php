<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
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
                            <?= $form->field($model, 'currentPassword')->passwordInput() ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'newPassword')->passwordInput() ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
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