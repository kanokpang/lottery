<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/5/2018
 * Time: 10:32 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h2><?= $model->team1->name . ' - ' . $model->team2->name; ?></h2>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, "scoreTeam1")->textInput(['maxlength' => true]) ?>
<?= $form->field($model, "scoreTeam2")->textInput(['maxlength' => true]) ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
