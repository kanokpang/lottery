<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;

?>
<?= $this->render('/user/left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="fa fa-newspaper-o font-green-meadow"></i>
                        <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Feed News Last') ?></span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="<?= Url::to(['/news-feed/index']) ?>"> ของฉัน </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['/news-feed/all']) ?>"> ทั้งหมด </a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div>
                        <div id="warning-code-flf1" class="alert alert-block alert-danger fade in display-hide"
                             style="display: block;">
                            <button type="button" class="close" data-dismiss="alert"
                                    onclick="App.warning('flf1',true);"></button>
                            <h4 class="alert-heading">คำเตือน</h4>
                            <p>เราไม่ได้ทำฟีดข่าวมาเพื่อแจ้งปัญหา หากคุณมีปัญหากรุณาคลิกที่นี่ <a
                                        href="<?= Url::to(['/issue/index']) ?>">ขอความช่วยเหลือ</a>
                                เพื่อที่เราจะได้ช่วยเหลือคุณได้ทันที</p>
                        </div>
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($feedNews, 'description')->textarea(['rows' => '6']) ?>

                        <?= $form->field($feedNews, 'captcha')->widget(Captcha::className())->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Post'), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <hr>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
