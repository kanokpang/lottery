<?php


use kartik\date\DatePicker;
use yii\widgets\ActiveForm;

?>

<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 form-box">
    <form role="form" action="" method="post" class="f1">
        <?php
        $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]); ?>
        <h3>Register To Lottery App</h3>
        <p>Fill in the form to get instant access</p>
        <div class="f1-steps">
            <div class="f1-progress">
                <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"
                     style="width: 16.66%;"></div>
            </div>
            <div class="f1-step active">
                <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                <p>Account</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-briefcase"></i></div>
                <p>Profile</p>
            </div>
            <div class="f1-step">
                <div class="f1-step-icon"><i class="fa fa-commenting-o"></i></div>
                <p>Social</p>
            </div>
        </div>
        <fieldset>
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
            <h4>Set up your account:</h4>
            <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                   value="<?= Yii::$app->request->csrfToken ?>"/>
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password_hash')->passwordInput() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'repeatPassword')->passwordInput() ?>
            </div>
            <div>

    
<div class="f1-buttons">

                <button type="button" class="btn btn-previous">Previous</button>
                <button id="step1" type="button" class="btn btn-next">Next</button>
               
            </div>


            
<br>
            <a href="/lottery/frontend/web/site/login" class="btn btn-warning btn-lg btn-block" role="button" aria-pressed="true">เป็นสมาชิกอยู่แล้ว</a>




        </fieldset>

        <fieldset>
            <h4>Tell us who you are:</h4>
            <div class="form-group">
                <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'birthDate')->widget(DatePicker::classname(), [
                    'language' => 'th',
                    'options' => ['placeholder' => Yii::t('app', 'Select birth date')],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'address')->textArea() ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'bankId')->dropDownList($listData, ['prompt' => Yii::t('app', 'Choose Select')]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'numberBank')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'groupName')->dropDownList($groupData, ['prompt' => Yii::t('app', 'Choose Select Group')]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'referenceReferCode')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="f1-buttons">
                <button id="step2" type="button" class="btn btn-next">Next</button>
            </div>
        </fieldset>

        <fieldset>
            <h4>Social media profiles:</h4>
            <div class="form-group">
                <?= $form->field($model, 'lineId')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous">Previous</button>
                <button id="submit" type="submit" class="btn btn-submit">Submit</button>
            </div>
        </fieldset>
        <?php ActiveForm::end(); ?>
    </form>
</div>