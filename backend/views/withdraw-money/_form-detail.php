<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 15/3/2561
 * Time: 22:26
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model,'detail')->textarea(['cols' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>