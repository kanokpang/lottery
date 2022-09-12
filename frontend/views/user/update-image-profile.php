<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .file-drop-zone{
        height: 50%;
    }
</style>
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
                    <?php $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data']
                    ]); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'profileImage')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => [
                                    'showUpload' => false,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'allowedFileExtensions' => ['jpg', 'png'],
                                    'initialPreview' => $model->getPhotoViewer(),
                                    'initialPreviewAsData' => true,
                                    'fileActionSettings' => [
                                        'showZoom' => false,
                                        'showRemove' => false,
                                    ],
                                ],
                            ]); ?>
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