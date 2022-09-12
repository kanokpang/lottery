<?php

use yii\bootstrap\Alert;
//use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

//Yii::$app->clientScript->registerCoreScript('jquery')
?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<ul class="tab-group">
    <center>
        <li class="tab"><a href="#login">Log In</a></li>
    </center>
</ul>

<div class="tab-content">


    <div id="login">
        <h1>Welcome!</h1>

        <?php
        $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])
            ->input('username', ['placeholder' => Yii::t('app', 'UserName')])->label(false)
        ?>

        <?= $form->field($model, 'password')->passwordInput()
            ->input('password', ['placeholder' => Yii::t('app', 'Password')])->label(false)
        ?>

        

        
       <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha::className(),
           ['siteKey' => '6LfN8kYUAAAAAArvxb5JkPaOuAQnXt4fbiW9DuHA'])->label(false) ?>

      <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>

            
        </div>

       <!--  <div lass="form-group">
            If you forgot your password you can <?= Html::a('forgot password', ['site/forgot-password'],['class' => 'btn-grey-mint btn-lg btn-block', 'name' => 'forgot-password-button']) ?>
        </div> -->


<div class="form-actions " align="center">
        
           <?= Html::a('ลืมรหัสผ่าน', ['site/forgot-password'],['class' => 'btn grey-gallery uppercase', 'name' => 'forgot-password-button']) ?>




            <a href="#" class="btn grey-gallery uppercase">ลืม Username?</a>
            </div>




        <?php ActiveForm::end(); ?>

<div class="form-actions">
        <?= Html::a('สมัครสมาชิก', ['site/signup'],['class' => 'btn btn-warning btn-lg btn-block', 'name' => 'signup-button']) ?>
        
      
    </div>
    </div>
    <!--/.Call to action-->


</div><!-- tab-content -->


