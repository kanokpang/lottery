<?php

use backend\models\AnswerIssue;
use backend\models\Issue;
use backend\models\TransferMoney;
use backend\models\WinLottery;
use backend\models\WithdrawMoney;
use common\models\User;
use yii\helpers\Url;

?>

<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="<?= Yii::$app->getUser()->identity->profileImage ?
                            Yii::getAlias('@web') . '/' . 'profile/' . Yii::$app->getUser()->identity->profileImage :
                            'http://placehold.it/128x128' ?>"
                             alt=""><?= Yii::$app->user->identity->firstName . ' ' . Yii::$app->user->identity->lastName ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= Url::to(['user/view', 'id' => Yii::$app->user->id]) ?>"> Profile</a>
                        </li>
                        <li><a href="<?= Url::to(['site/logout']) ?>" data-method="post"><i
                                        class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
                <?php
                $transferMoneys = TransferMoney::find()->where(['status' => 0])->asArray()->all();
                $withDrawMoney = WithdrawMoney::find()->where(['status' => 0])->asArray()->all();
                $users = User::find()->where(['status' => User::STATUS_PADDING])->asArray()->all();
                $countTransfer = count($transferMoneys);
                $countWithDraw = count($withDrawMoney);
                $countUser = count($users);
                $countNotificationMoney = $countWithDraw + $countTransfer + $countUser;
                ?>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-green"><?= $countNotificationMoney ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <?php
                        foreach ($transferMoneys as $transferMoney) {
                            ?>
                            <li>
                                <a href="<?= Url::to(['/bank/index',
                                    'id' => 'transfer',
                                    'TransferMoneySearch[money]' => $transferMoney['money'],
                                    'TransferMoneySearch[createdAt]' => $transferMoney['createdAt']
                                ]) ?>">
                                    <span>รายการเงินฝาก</span>
                                    <span class="time"><?= $transferMoney['createdAt'] ?></span>
                                    </span>
                                    <span class="message">
                                        จำนวนเงินที่รอการยืน <?= number_format($transferMoney['money'], 2) ?> บาท
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        foreach ($withDrawMoney as $withDraw) {
                            ?>
                            <li>
                                <a href="<?= Url::to(['/bank/index',
                                    'id' => 'withdraw',
                                    'WithdrawMoneySearch[money]' => $withDraw['money'],
                                    'WithdrawMoneySearch[createdAt]' => $withDraw['createdAt']]) ?>">
                                    <span>รายการถอนเงิน</span>
                                    <span class="time"><?= $withDraw['createdAt'] ?></span>
                                    </span>
                                    <span class="message">
                                        จำนวนเงินที่รอการยืน <?= number_format($withDraw['money'], 2) ?> บาท
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        foreach ($users as $user) {
                            ?>
                            <li>
                                <a href="<?= Url::to(['/user/index', 'UserSearch[createdAt]' => $user['createdAt']]) ?>">
                                    <span>ตัวแทนขายที่รอการยืนยัน</span>
                                    <span class="time"><?= $user['createdAt'] ?></span>
                                    </span>
                                    <span class="message">
                                        ชื่อ <?= $user['firstName'] . ' ' . $user['lastName'] ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
                $winLotteried = WinLottery::find()->where(['answer' => 0])->all();
                $countWinLottey = count($winLotteried);
                ?>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="badge bg-green"><?= $countWinLottey ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <?php
                        foreach ($winLotteried as $winLotttery) {
                            ?>
                            <li>
                                <a href="<?= Url::to(['lottery-period/index',
                                    'id' => 'lottery-result',
                                    'WinLotterySearch[lotteryId]' => $winLotttery->lotteryId,
                                    'WinLotterySearch[number]' => $winLotttery->number
                                ]) ?>">
                                    <span>รายการที่รอเฉลย</span>
                                    <span class="message">
                                        หวยประจำวันที่ <?= $winLotttery->lottery->name ?>
                                        เลข <?= $winLotttery->number ?>
                                        <?= $winLotttery->typeLottery->name ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
                $countIssue = 0;
                $issuesIds = [];
                $issues = Issue::find()->all();
                foreach ($issues as $issue) {
                    $issuesId = $issue->id;
                    $answerIssue = AnswerIssue::find()->select('id')->where(['issueId' => $issuesId])->count();
                    if (!$answerIssue) {
                        $countIssue += 1;
                        $issuesIds[] = $issuesId;
                    }
                }
                if ($issuesIds) {
                    $issueNotifications = Issue::findAll(['id' => $issuesIds]);
                }
                ?>
                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green"><?= $countIssue ?></span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <?php
                        if (isset($issueNotifications)) {
                            foreach ($issueNotifications as $issueNotification) {
                                ?>
                                <li>
                                    <a href="<?= Url::to(['/issue/index',
                                        'IssueSearch[name]' => $issueNotification->name,
                                        'IssueSearch[createdAt]' => $issueNotification->createdAt
                                    ]) ?>">
                                        <span>รายการปัญหาที่รอการตอบกลับ</span>
                                        </span>
                                        <span class="message">
                                            หัวข้อ: <?= $issueNotification->name ?><br>
                                            ชื่อ-สกุล: <?= $issueNotification->user->fullName ?><br>
                                            วันที่สร้าง: <?= $issueNotification->createdAt ?>
                                        </span>
                                    </a>
                                </li>
                            <?php }
                        } ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>

</div>