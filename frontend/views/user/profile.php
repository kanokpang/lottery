<?php

use yii\helpers\Url;

$this->registerCssFile('@web/css/profile.min.css');
$this->registerCssFile('@web/css/components-md.min.css');
?>
<?= $this->render('left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<div class="profile-content">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-green-jungle">
                            <span data-count-up="" data-value="<?= $wallet->total; ?>"> <?= number_format($wallet->total,2) ?></span>
                        </h3>
                        <small>ยอดเงินในบัญชี</small>
                    </div>
                    <div class="icon">
                        <i class="icon-wallet"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-success green-jungle"></span>
                    </div>
                    <div class="status">
                        <div class="status-title"> ยอดเงินของคุณ ณ ขณะนี้</div>
                        <div class="status-number"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-red-haze">
                            <span data-count-up="" data-value="0.00">0.00</span>
                        </h3>
                        <small>ค่าคอมมิชชั่น</small>
                    </div>
                    <div class="icon">
                        <i class="icon-users"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-success red-haze"></span>
                    </div>
                    <div class="status">
                        <div class="status-title"> ค่าคอมมิชชั่นคงเหลือของคุณ</div>
                        <div class="status-number"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                    <div class="number">
                        <h3 class="font-blue-steel">
                            <span data-count-up="" data-value="<?= $buyLottery ?>" data-decimals="<?= $buyLottery ?>"><?= $buyLottery ?></span>
                        </h3>
                        <small>โพยหวยรอตรวจสอบ</small>
                    </div>
                    <div class="icon">
                        <i class="icon-doc"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-success blue-steel">
                        </span>
                    </div>
                    <div class="status">
                        <div class="status-title"> โพยหวยทั้งหมดของคุณ</div>
                        <div class="status-number"><?= $buyLottery ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <span class="caption-subject font-red bold uppercase">โปรไฟล์</span>
                    </div>
                </div>
                <div class="portlet-body notification">
                    <ul class="text-decoration-none">
                        <i class="fa fa-user-circle"></i>
                        <span style="font-weight: bolder">User Name:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->username ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-envelope"></i>
                        <span style="font-weight: bolder">E-Mail:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->email ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-address-card"></i>
                        <span style="font-weight: bolder">ชื่อ-นามสกุล:</span> <span class="fcaption-subject font-blue-madison bold uppercase"><?= $model->fullName ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-birthday-cake"></i>
                        <span style="font-weight: bolder">วันเดือนปีเกิด:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->birthDate ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-map-marker"></i>
                        <span style="font-weight: bolder">ที่อยู่:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->address ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-mobile"></i>
                        <span style="font-weight: bolder">เบอร์มือถือ:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->mobile ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-comments"></i>
                        <span style="font-weight: bolder">Line ID:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->lineId ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-university"></i>
                        <span style="font-weight: bolder">เลขบัญชีธนาคาร :</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->bank->name ?>
                        - <?= $model->numberBank ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-btc"></i>
                        <span style="font-weight: bolder">เงินคงเหลือในระบบ:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= number_format($total) ?></span>
                    </ul>
                    <ul class="text-decoration-none">
                        <i class="fa fa-registered"></i>
                        <span style="font-weight: bolder">Refer Code:</span> <span class="caption-subject font-blue-madison bold uppercase"><?= $model->referCode ?></span>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET -->
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">บันทึกการเข้า - ออกระบบ</span>
                    </div>
                </div>
                <div class="portlet-body log-login">
                    <ul class="feeds">
                        <?php foreach ($userLogs as $userLog) { ?>
                            <li>
                                <a href="javascript:;">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-bar-chart-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    <?php
                                                    echo Yii::t('app', 'Ip Address: ');
                                                    echo $userLog['ipAddress'] . ' ';
                                                    echo intval($userLog['status']) === 1 ? 'Login' : 'Logout';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date"><?php
                                            $createdAt = $userLog['createdAt'];
                                            $date = new DateTime($createdAt);
                                            $timeStamp = $date->getTimestamp();
                                            echo Yii::$app->formatter->asRelativeTime($timeStamp, 'now') ?></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <!-- END PORTLET -->                    </div>
    </div>
</div>