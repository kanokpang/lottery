<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NoteTransferMoney */
/* @var $form ActiveForm */
$this->title = Yii::t('app', 'Note Transfer Money');
?>
    <h2><?= $this->title ?></h2>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $noteTransferMoney->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete note transfer money this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="backend-views-transfer-money">

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'status')->dropDownList([
    '0' => Yii::t('app', 'Pending'),
    '1' => Yii::t('app', 'Complete'),
    '2' => Yii::t('app', 'Cancel')], ['prompt' => Yii::t('app', 'Select Status'), 'disabled' => ($model->status !== 0) ? 'disabled' : false]) ?>
<?= $form->field($noteTransferMoney, 'note')->textarea(['rows' => '6']) ?>
<?= $form->field($noteTransferMoney, 'photos[]')->widget(FileInput::classname(), [
    'options' => [
        'multiple' => true,
    ],
    'pluginOptions' => [
        'initialPreview' => $noteTransferMoney->getPhotosViewer(),
        'allowedFileExtensions' => ['jpg', 'png'],
        'initialPreviewAsData' => true,
        'maxFileCount' => 5,
        'showRemove' => false,
        'showUpload' => false,
        'fileActionSettings' => [
            'showRemove' => false,
        ],
    ]
]); ?>
<?php if ($model->status === 0) { ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Submits'), ['class' => 'btn btn-primary']) ?>
    </div>
<?php } ?>
<?php ActiveForm::end(); ?>