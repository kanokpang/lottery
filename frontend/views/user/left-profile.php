<?php

use yii\helpers\Url;

$this->registerCssFile('@web/css/profile.min.css');
$this->registerCssFile('@web/css/components-md.min.css');
?>

<div class="profile-sidebar">
    <div class="portlet light profile-sidebar-portlet">
        <div class="profile-userpic center-block" align="center">
            <img src="<?= Yii::$app->user->identity->profileImage ? Url::to('@web/profile/'.Yii::$app->user->identity->profileImage) : Url::to('@web/img/avatar-small.jpg') ?>" class="img-responsive" alt=""
                 style="height: auto; max-height: 50%;">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">
                <p class="font-blue-dark text-decoration-none"><?= Yii::$app->user->identity->fullName ?> </p>
            </div>
            <div class="profile-usertitle-job">
                <span class="font-position-normal-user"><?= $userGroup->group->name ?></span>
            </div>
        </div>
        <div class="profile-usermenu">
            <ul class="nav">
                <li class="<?= Yii::$app->controller->action->id === 'profile' ? 'active' : ''?>">
                    <a href="<?= Url::to(['/user/profile', 'id' => $model->id]) ?>"><?= Yii::t('app', 'Profile') ?></a>
                </li>
                <?php
                $settingProfileActive = '';
                if (Yii::$app->controller->action->id === 'setting-profile' ||
                    Yii::$app->controller->action->id === 'update-image-profile' ||
                    Yii::$app->controller->action->id === 'update-password') {
                    $settingProfileActive = 'active';
                }
                ?>
                <li class="<?= Yii::$app->controller->id === 'news-feed' ? 'active' : ''?>">
                    <a href="<?= Url::to(['/news-feed/index']) ?>"><?= Yii::t('app', 'News Feed') ?></a>
                </li>
                <li class="<?= $settingProfileActive ?>">
                    <a href="<?= Url::to(['/user/setting-profile', 'id' => $model->id]) ?>"><?= Yii::t('app', 'Setting Profile') ?></a>
                </li>
                <li class="<?= Yii::$app->controller->action->id === 'setting-bank' ? 'active' : ''?>">
                    <a href="<?= Url::to(['/user/setting-bank', 'id' => $model->id])?>"><?= Yii::t('app','Setting Bank')?></a>
                </li>
                <li class="<?= Yii::$app->controller->id === 'issue' ? 'active' : ''?>">
                    <a href="<?= Url::to(['/issue/index']) ?>"><?= Yii::t('app', 'Help') ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="portlet light">
        <div>
            <h4 class="profile-desc-title">ข้อมูลสำคัญของคุณ</h4>
            <span class="profile-desc-text">โปรดตรวจสอบอยู่เสมอว่า ข้อมูลของคุณไม่ได้ถูกเปลี่ยนแปลงและถูกต้อง </span>
        </div>
    </div>
</div>