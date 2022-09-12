<?php

use backend\models\AnswerIssue;
use backend\models\Issue;
use backend\models\Menu;
use backend\models\TransferMoney;
use backend\models\WithdrawMoney;
use common\models\User;
use frontend\assets\AppAssetLottery;
use yii\helpers\Html;
use yii\helpers\Url;

AppAssetLottery::register($this);
$active = '';
?>
<?= Html::csrfMetaTags() ?>
<?php $this->beginPage(); ?>

<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title> Lotto88Lucky เว็บแทงหวยออนไลน์ - Lotto88Lucky เว็บแทงหวยออนไลน์</title>
    <?php $this->head() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="description"
          content="อันดับหนึ่งในเรื่องการบริการหวย ด้วยระบบออนไลน์ที่ทันสมัย สมบูรณ์แบบ พร้อมด้วยทีมงานมืออาชีพที่คอยดูแลและระบบเซิฟเวอร์ที่มีประสิทธิภาพ">

    <meta name="msapplication-TileColor" content="#ffffff">

    <meta name="theme-color" content="#ffffff">

</head>
<body class="page-md page-header-menu-fixed">
<div class="page-header">
    <div class="page-header-top">
        <div class="container">
            <div class="page-logo">
                <a href="./">
                    <img src="<?= Yii::getAlias('@web/img/logo-small.png') ?>" alt="logo" class="logo">
                </a>
            </div>
            <a href="javascript:;" class="menu-toggler"></a>
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-extended dropdown-dark">
                            <a href="#"
                               class="dropdown-toggle"
                               data-toggle="dropdown"
                               data-close-others="true">
                                <i class="fa fa-bitcoin"></i>
                                <span class="wallet">
                                <span id="my_money"><?= number_format(User::findWallet(Yii::$app->user->id, 2)); ?></span> บาท
                            </span>
                            </a>
                        </li>
                        <?php
                        $withDrawMoneys = WithdrawMoney::find()->where('YEARWEEK(createdAt) = YEARWEEK(CURRENT_DATE) and status = 1')->andWhere(['createdBy' => Yii::$app->user->id])->all();
                        $transferMoneys = TransferMoney::find()->where('YEARWEEK(createdAt) = YEARWEEK(CURRENT_DATE) and status = 1')->andWhere(['userId' => Yii::$app->user->id])->all();
                        $answerIssues = AnswerIssue::find()->select([
                            AnswerIssue::tableName(). '.id',
                            AnswerIssue::tableName(). '.description',
                            AnswerIssue::tableName(). '.issueId',
                            AnswerIssue::tableName(). '.createdBy',
                            AnswerIssue::tableName(). '.createdAt',
                            Issue::tableName(). '.id',
                            Issue::tableName(). '.createdBy',
                        ])->joinWith('issue')->where([
                            Issue::tableName(). '.createdBy' => Yii::$app->user->id,
                        ])->andWhere(AnswerIssue::tableName(). '.createdAt IN ( SELECT max(`lol_answer_issue`.createdAt) AS createdAt FROM '. AnswerIssue::tableName().' GROUP BY issueId)')
                        ->orderBy('createdAt DESC')->having([
                            '<>' , AnswerIssue::tableName(). '.createdBy', Yii::$app->user->id
                        ])->groupBy('issueId')->all();
                        $totalCountMoney = count($transferMoneys) + count($withDrawMoneys);
                        ?>
                        <li class="dropdown dropdown-extended dropdown-dark  dropdown-notification">
                            <a href="javascript:;" class="dropdown-toggle <?= $totalCountMoney ? 'blink' : '' ?>" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="fa fa-money"></i>
                                <span class="badge bg-red"><?= $totalCountMoney ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3 class="bold font-green-meadow"><i class="fa fa-gg font-green-meadow"></i>คุณมี <?= count($transferMoneys) + count($withDrawMoneys) ?> การแจ้งเตือนเกี่ยวกับการฝากเงิน - ถอนเงิน</h3>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;"><ul class="dropdown-menu-list scroller current-server-list" style="height: auto; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <?php foreach ($transferMoneys as $transferMoney) { ?>
                                            <li>
                                                <a href="<?= Url::to(['deposit/index', 'TransferMoneySearch[id]' => $transferMoney->id])?>">
                                                    <span class="time font-green-haze"><?= $transferMoney->createdAt ?></span>
                                                    <div class="details dot-dot-dot font-green-haze">
                                                        ทีมงานได้ปรับยอดรายการฝากเงิน<br>จำนวน <?= number_format($transferMoney->money) ?> บาท
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <?php foreach ($withDrawMoneys as $withDrawMoney) { ?>
                                                <li>
                                                    <a href="<?= Url::to(['withdraw/index', 'WithdrawMoneySearch[id]' => $withDrawMoney->id])?>">
                                                        <span class="time font-red-haze"><?= $withDrawMoney->createdAt ?></span>
                                                        <div class="details dot-dot-dot font-red-haze">
                                                            ทีมงานได้ปรับยอดรายการถอนเงิน<br>จำนวน <?= number_format($withDrawMoney->money) ?> บาท
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-extended dropdown-dark  dropdown-notification">
                            <a href="javascript:;" class="dropdown-toggle <?= count($answerIssues) ? 'blink' : '' ?>" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-red"><?= count($answerIssues) ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3 class="bold font-red-meadow"><i class="fa fa-gg font-red-meadow"></i>คุณมี <?= count($answerIssues) ?> การแจ้งเตือนเกี่ยวกับความช่วยเหลือ</h3>
                                </li>
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 275px;"><ul class="dropdown-menu-list scroller current-server-list" style="height: 275px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
                                            <?php foreach ($answerIssues as $answerIssue) { ?>
                                                <li>
                                                    <a href="<?= Url::to(['issue/view', 'id' => $answerIssue->issueId])?>">
                                                        <span class="time font-red-haze"><?= $answerIssue->createdAt ?></span>
                                                        <div class="details dot-dot-dot font-red-haze">
                                                            ทีมงานได้ตอบกลับความช่วยเหลือของคุณ
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="droddown dropdown-separator">
                            <span class="separator"></span>
                        </li>
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                <img alt="" class="img-circle" src="<?= Yii::$app->user->identity->profileImage ? Url::to('@web/profile/'.Yii::$app->user->identity->profileImage) : Yii::getAlias('@web/img/avatar-small.jpg')?>">
                                <span class="username username-hide-mobile"><?= Yii::$app->user->identity->fullName?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?= Url::to(['user/profile', 'id' => Yii::$app->user->id])?>">
                                        <i class="fa fa-user"></i> <?= Yii::t('app','My Profile') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['issue/index'])?>">
                                        <i class="fa fa-handshake-o" aria-hidden="true"></i> <?= Yii::t('app','Help') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['bill-lottery/list'])?>">
                                        <i class="fa fa-file-text-o"></i> <?= Yii::t('app','Chit Lottery') ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['transaction/index'])?>">
                                        <i class="fa fa-bar-chart"></i><?= Yii::t('app','Transaction Money')?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['user/log'])?>">
                                        <i class="fa fa-list"></i> <?= Yii::t('app','Save Log')?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['site/logout'])?>" data-method="post">
                                        <i class="fa fa-sign-out"></i> <?= Yii::t('app','Sign Out')?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="page-header-menu">
        <div class="container">
            <div class="hor-menu ">
                <ul class="nav navbar-nav">
                    <li class="<?= $this->context->route === 'site/index' ? 'active' : '' ?>">
                        <a href="<?= Url::to(['site/index']) ?>">หน้าแรก</a>
                    </li>
                    <?php
                    $menus = Menu::find()->where(['parentId' => null, 'status' => true])->all();
                    foreach ($menus as $key => $menu) {
                        if ($menu['url'] != '#' && !$menu['parentId']) {
                            $url = 'site/news?id=' . $menu['id'];
                            ?>
                            <li class="<?= 'site/news?id=' . Yii::$app->request->get('id') === $url ? 'active' : '' ?>">
                                <a href="<?= Url::to([$url]) ?>"><?= $menu['name'] ?></a>
                            </li>
                        <?php } else { ?>

                            <li class="menu-dropdown classic-menu-dropdown   ">
                                <a href="#">
                                    <?= $menu['name'] ?>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <?php
                                    $parentMenus = Menu::find()->where(['parentId' => $menu['id']])->all();
                                    foreach ($parentMenus as $parentMenu) {
                                        $menuId = $parentMenu['id'] - 1;
                                        $url = 'site/news?id=' . $menuId;
                                        ?>
                                        <li>
                                            <a href="<?= Url::to([$url]); ?>"
                                               class="nav-link <?= 'site/news?id=' . Yii::$app->request->get('id') === $url ? 'active' : '' ?>"> <?= $parentMenu['name'] ?> </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                    }
                    if (!Yii::$app->user->isGuest) {
                        ?>
                        <li class="menu-dropdown mega-menu-dropdown  ">
                            <a data-hover="megamenu-dropdown"
                               data-close-others="true"
                               data-toggle="dropdown"
                               href="#"
                               class="dropdown-toggle">
                                หวยออนไลน์ <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu" style="min-width: 475px">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>แทงหวย</h3>
                                                    </li>
                                                    <?php
                                                    if ($this->context->route === 'lottery/index' ||
                                                        $this->context->route === 'lottery/promotion') {
                                                        $active = 'active';
                                                    }
                                                    ?>
                                                    <li class="<?= $active ? $active : '' ?>">
                                                        <a href="<?= Url::to(['lottery/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            หวยรัฐบาล
                                                        </a>
                                                    </li>
                                                    <li class="<?= $this->context->route === 'bill-lottery/index' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['bill-lottery/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            บิลหวย
                                                        </a>
                                                    </li>
                                                    <li class="<?= $this->context->route === 'bill-lottery/list' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['bill-lottery/list']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            โพยหวย
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>ผลหวย</h3>
                                                    </li>
                                                    <li class="">
                                                        <a href="<?= Url::to(['lottery/lottery-result'])?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            ผลหวยรัฐบาล
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-dropdown mega-menu-dropdown  ">
                            <a data-hover="megamenu-dropdown"
                               data-close-others="true"
                               data-toggle="dropdown"
                               href="#"
                               class="dropdown-toggle">
                                บอลออนไลน์ <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu" style="min-width: 475px">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>แทงบอล</h3>
                                                    </li>
                                                    <?php
                                                    if ($this->context->route === 'football/index') {
                                                        $active = 'active';
                                                    }
                                                    ?>
                                                    <li class="<?= $active ? $active : '' ?>">
                                                        <a href="<?= Url::to(['football/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            แทงบอล
                                                        </a>
                                                    </li>
                                                    <li class="<?= $this->context->route === 'buy-football/index' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['buy-football/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            รายการบอลที่แทง
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>ผลบอล</h3>
                                                    </li>
                                                    <li class="<?= $this->context->route === 'football/result' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['football/result'])?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            ผลบอล
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-dropdown mega-menu-dropdown  ">
                            <a data-hover="megamenu-dropdown"
                               data-close-others="true"
                               data-toggle="dropdown"
                               href="#"
                               class="dropdown-toggle">
                                ฝากถอนเงิน <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu" style="min-width: 475px">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>ฝากเงินเข้า</h3>
                                                    </li>
                                                    <li class="<?= Yii::$app->controller->getRoute() === 'deposit/create' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['deposit/create']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            แจ้งฝากเงิน
                                                        </a>
                                                    </li>
                                                    <li class="<?= Yii::$app->controller->getRoute() === 'deposit/index' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['deposit/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            รายการฝากเงิน
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="mega-menu-submenu">
                                                    <li>
                                                        <h3>ถอนเงินออก</h3>
                                                    </li>
                                                    <li class="<?= Yii::$app->controller->getRoute() === 'withdraw/create' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['withdraw/create']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            แจ้งถอนเงินออก
                                                        </a>
                                                    </li>
                                                    <li class="<?= Yii::$app->controller->getRoute() === 'withdraw/index' ? 'active' : '' ?>">
                                                        <a href="<?= Url::to(['withdraw/index']) ?>"
                                                           class="iconify">
                                                            <i class="fa fa-angle-right"></i>
                                                            รายการถอนเงิน
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php } else { ?>

                        <li class="">
                            <a href="<?= Url::to(['site/guarantee', 'id' => 1]); ?>">คำยืนยัน</a>
                        </li>

                        <li class="">
                            <a href="<?= Url::to(['site/news', 'id' => 1]); ?>">ติดต่อเรา</a>
                        </li>
                        <li class="">
                            <a href="<?= Url::to(['site/signup']); ?>" style="color: #FFFFFF;">ลงทะเบียน</a>
                        </li>
                        <li class="">
                            <a href="<?= Url::to(['site/login']); ?>" style="color: #FFFFFF;">เข้าสู่ระบบ</a>
                        </li>

                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<div class="page-container">
    <div class="page-head">
        <div class="container">
            <div class="page-title">
                <h1>
                    Lotto88Lucky เว็บแทงหวยออนไลน์
                    <small>อันดับหนึ่งในเรื่องการบริการหวย ด้วยระบบออนไลน์ที่ทันสมัย สมบูรณ์แบบ
                        พร้อมด้วยทีมงานมืออาชีพที่คอยดูแลและระบบเซิฟเวอร์ที่มีประสิทธิภาพ
                    </small>
                </h1>
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="page-content-inner">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<div class="page-footer">
    <div class="container">
        2018 © Lotto88Lucky เว็บแทงหวยออนไลน์, ทำงานด้วยระบบ Cloud Server ออนไลน์พร้อมสำรองข้อมูลตลอด 24 ชั่วโมง
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END JAVASCRIPTS -->
<?php $this->endBody(); ?>
</body>
<!-- END BODY -->
</html>
<?php $this->endPage(); ?>
