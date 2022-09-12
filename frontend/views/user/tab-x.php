<?php
use yii\helpers\Url;
?>
<div class="caption caption-md">
    <i class="icon-globe theme-font hide"></i>
    <span class="caption-subject font-blue-madison bold uppercase">
        <?= Yii::t('app','Setting Profile')?>
    </span>
</div>
<ul class="nav nav-tabs">
    <li class="<?= Yii::$app->controller->action->id === 'setting-profile' ? 'active' : '' ?>">
        <a href="<?= Url::to(['setting-profile', 'id' => Yii::$app->user->id ])?>">
            <?= Yii::t('app','Profile')?>
        </a>
    </li>
    <li class="<?= Yii::$app->controller->action->id === 'setting-bank' ? 'active' : '' ?>">
        <a href="<?= Url::to(['setting-bank','id' => Yii::$app->user->id])?>">
            <?= Yii::t('app','Setting Bank') ?>
        </a>
    </li>
    <li class="<?= Yii::$app->controller->action->id === 'update-image-profile' ? 'active' : '' ?>">
        <a href="<?= Url::to(['update-image-profile','id' => Yii::$app->user->id])?>">
            <?= Yii::t('app','Update Image Profile') ?>
        </a>
    </li>
    <li class="<?= Yii::$app->controller->action->id === 'update-password' ? 'active' : '' ?>">
        <a href="<?= Url::to(['update-password', 'id' => Yii::$app->user->id])?>">
            <?= Yii::t('app','Update Password')?>
        </a>
    </li>
</ul>