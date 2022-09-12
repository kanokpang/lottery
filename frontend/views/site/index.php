<?php

use backend\models\CommentFeedNews;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="page-content">
    <div class="container">
        <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-home-slider hide">
                        <div id="home-slider">
                            <ul>
                                <li>
                                    <img src="<?= Yii::getAlias('@web/img/slider/promote-1.png') ?>"
                                         width="100%"></li>
                                <li>
                                    <img src="<?= Yii::getAlias('@web/img/slider/promote-2.png') ?>"
                                         width="100%"></li>
                                <li>
                                    <img src="<?= Yii::getAlias('@web/img/slider/promote-1.png') ?>"
                                         width="100%"></li>
                                <li>
                                    <img src="<?= Yii::getAlias('@web/img/slider/promote-2.png') ?>"
                                         width="100%"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row margin-top-10">
                <div class="col-md-8">
                    <div class="portlet light announce-home">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bullhorn font-red"></i>
                                <span class="caption-subject font-red bold uppercase">ประกาศ</span>
                                <span class="caption-helper">ข่าวประกาศสำคัญที่จะแจ้งให้ลูกค้าทุกท่านได้รับทราบ</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="message">
                                <?= $information->detail ?>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div id="desktop-news-feed-box">
                        <div class="portlet light" id="home-news-feed">
                            <div class="portlet-title tabbable-line">
                                <div class="caption">
                                    <i class="fa fa-newspaper-o font-green-meadow"></i>
                                    <span class="caption-subject font-green-meadow bold uppercase"> ฟีดข่าวล่าสุด</span>
                                    <span class="caption-helper">โพสต์สาธารณะที่สามาชิกโพสต์ในหน้าโปรไฟล์ของตัวเอง</span>
                                </div>
                                <div class="actions">
                                    <a href="<?= Url::to(['/news-feed/index']) ?>"
                                       class="btn btn-sm green-meadow  btn-outline btn-transparent">เขียนโพสต์</a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <?php foreach ($feedNews as $feedNew) {?>
                                <div class="mt-comments home-mt-comments">
                                    <div class="mt-comment padding-left-none padding-right-none">
                                        <div class="mt-comment-img">
                                            <img src="<?= $feedNew->user->profileImage ?
                                                Url::to('@web/profile/'.$feedNew->user->profileImage) :
                                                Url::to('@web/img/avatar-small.jpg') ?>"
                                                 width="45px" height="45px">
                                        </div>
                                        <div class="mt-comment-body">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author"><?= $feedNew->user->fullName ?></span>
                                                <span class="mt-comment-date margin-right-10"><a
                                                            href="<?= Url::to(['/news-feed/view', 'id' => $feedNew->id])?>"><i
                                                                class="fa fa-pencil"></i> ตอบกลับ</a></span>
                                                <span class="mt-comment-date margin-right-10">
                                                <a href="<?= Url::to(['/news-feed/view', 'id' => $feedNew->id])?>">
                                                    <i class="fa fa-search"></i> ดู</a>

                                            </span>
                                                <span class="mt-comment-date margin-right-10"
                                                      title="<?= $feedNew->createdAt ?>"><i class="fa fa-clock-o"></i><?= $feedNew->createdAt ?>
                                            </span>
                                                <span class="mt-comment-date margin-right-10">
                                                <?php $commentFeedNewsObjs = CommentFeedNews::findAll(['feedNewsId' => $feedNew->id]); ?>
                                                <i class="fa fa-comments"></i><?= count($commentFeedNewsObjs)?>
                                            </span>
                                            </div>
                                            <div class="mt-comment-text">
                                                <?= $feedNew->description ?>
                                            </div>
                                            <?php
                                            foreach ($commentFeedNewsObjs as $commentFeedNewsObj) {
                                                ?>
                                                <div class="mt-comment-details">
                                                    <div class="mt-comment padding-left-none padding-right-none">
                                                        <div class="mt-comment-img">
                                                            <img src="<?= $commentFeedNewsObj->user->profileImage ?
                                                                Url::to('@web/profile/'.$commentFeedNewsObj->user->profileImage) :
                                                                Url::to('@web/img/avatar-small.jpg') ?>" width="45px" height="45px"></div>
                                                        <div class="mt-comment-body">
                                                            <div class="mt-comment-info">
                                                                <span class="mt-comment-author"><?= $commentFeedNewsObj->user->fullName ?></span>
                                                                <span class="mt-comment-date margin-right-5" title="<?= $commentFeedNewsObj->createdAt ?>"><i class="fa fa-clock-o"></i><?= $commentFeedNewsObj->createdAt ?></span>
                                                            </div>
                                                            <div class="mt-comment-text">
                                                                <?= $commentFeedNewsObj->description ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="home-result-lotto">
                        <div class="dashboard-stat green-casablanca">
                            <div class="visual">
                                <i class="fa fa-ioxhost fa-icon-medium"></i>
                            </div>
                            <div class="details">
                                <div class="number"> ผลสลากกินแบ่งรัฐบาล</div>
                                <div class="desc">
                                    <?= $winLotterys ? $winLotterys[0]->lottery->name : '' ?>
                                </div>
                            </div>
                            <a class="more" href="http://lottery.kapook.com/">
                                ตรวจผลสลากกินแบ่งรัฐบาล
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                    <tr class="uppercase">
                                        <th width="60%" class="font-yellow-casablanca text-left">ประเภทหวย
                                        </th>
                                        <th width="20%" class="font-yellow-casablanca text-center">
                                            ตัวเลข
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($winLotterys as $winLottery) { ?>
                                        <tr>
                                            <td class="font-yellow-casablanca text-left"><?= $winLottery->typeLottery->name ?></td>
                                            <td class="font-yellow-casablanca text-center"><?= $winLottery->number ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="dashboard-stat red-mint">
                            <div class="visual">
                                <i class="fa fa-gg fa-icon-medium"></i>
                            </div>
                            <div class="details">
                                <div class="number"> หวยอั้น</div>
                                <div class="desc">
                                    <?= $lottery['name'] ?>
                                </div>
                            </div>
                            <a class="more"
                               href="#">
                                ดูผลหวยนี้
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                            <div class="table-scrollable table-scrollable-borderless">
                                <table class="table table-hover table-light">
                                    <thead>
                                    <tr class="uppercase">
                                        <th width="20%" class="font-red-flamingo text-left">รอบหวย
                                        </th>
                                        <th width="60%" class="font-red-flamingo">
                                            เงื่อนไข
                                        </th>
                                        <th width="20%" class="font-red-flamingo">
                                            ตัวเลข
                                        </th>
                                        <th width="20%" class="font-red-flamingo">
                                            จำกัดการซื้อ
                                        </th>
                                        <th width="20%" class="font-red-flamingo">
                                            เหลือ
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($conditionLottery as $condition) { ?>
                                        <tr>
                                            <?php $orderLottery = \backend\models\OrderLottery::find()->where([
                                                'orderLotteryId' => $condition->lotteryId,
                                                'number' => $condition->number])->count() ?>
                                            <td class="font-red-flamingo text-left"><?= $condition->typeLottery->name ?></td>
                                            <td class="font-red-flamingo"><?= $condition->isPurchaseLimit ?
                                                    Yii::t('app', Yii::t('app', 'Purchase Limit')) :
                                                    Yii::t('app', 'Not for sale') ?>
                                            </td>
                                            <td class="font-red-flamingo"><?= $condition->number ?></td>
                                            <td class="font-red-flamingo"><?= $condition->limit ?></td>
                                            <td class="font-red-flamingo"><?= $condition->isPurchaseLimit ? $condition->limit - $orderLottery : '-' ?></td>
                                        </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="dashboard-stat red-flamingo">
                            <div class="visual">
                                <i class="fa fa-gg fa-icon-medium"></i>
                            </div>
                            <div class="details">
                                <div class="number"> ผลบอล</div>
                                <div class="desc">
                                    ของวันที่
                                    14/02/2018
                                </div>
                            </div>
                            <a class="more"
                               href="#">
                                ดูผลบอลนี้ CLIK!!
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                            <div class="table-scrollable table-scrollable-borderless">

                                </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="dashboard-stat yellow">
                            <div class="visual">
                                <i class="fa fa-gg fa-icon-medium"></i>
                            </div>
                            <div class="details">
                                <div class="number"> ตารางบอล</div>
                                <div class="desc">
                                    ของวันที่
                                    07/02/2018 - 14/02/2018
                                </div>
                            </div>
                            <a class="more"
                               href="#">
                                ดูผลบอล
                                <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                        <div>
                            <?= Html::img('@web/img/advertising/3.gif', ['width' => '360', 'height' => '112']) ?>
                        </div>
                        <div style="margin-top: 30px;">
                            <?= Html::img('@web/img/advertising/2.gif', ['width' => '360', 'height' => '112']) ?>
                        </div>
                        <div style="margin-top: 30px;">
                            <?= Html::img('@web/img/advertising/1.gif', ['width' => '360', 'height' => '112']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>