<?php

use backend\models\Lottery;
use backend\models\PromotionLottery;

$lottery = Lottery::find()->where(['id' => $buyLottery[0]['payment']['lotteryId']])->all();
$promotionLottery = PromotionLottery::find()->where(['id' => $buyLottery[0]['payment']['promotionLotteryId']])->all();
$date = strtotime($lottery[0]['startDateTime']);
$dateNewFormat = date('d/m', $date);
?>

<table align="center" style="padding-top: -40px">
    <tr>
        <td>
            <div align="center">
                <p style="font-size: 5px">รหัสบิล : <?= $model->name ?></p>
                <p style="font-size: 5px">รอบวันที่ <?= $dateNewFormat ?> </p>
                <p style="font-size: 5px">Lotto thai88</p>
                <p style="font-size: 5px">งวดประจำวันที่: <?= $lottery[0]['name']?></p>
                <p style="font-size: 5px">ประเภท: <?= $promotionLottery[0]['name'] ?></>
            </div>
        </td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <th align="center" style="
        border-style: dotted;
        text-decoration: none;
        border-bottom: 1px;
        border-top: 1px;
        border-color: #000000;"><p style="font-size: 5px">ตัวเลข</p></th>
        <th align="center" style="
        border-style: dotted;
        text-decoration: none;
        border-bottom: 1px;
        border-top: 1px;
        border-color: #000000;"><p style="font-size: 5px">ประเภท</p></th>
        <th align="center" style="
            border-bottom: 1px;
            border-top: 1px;
            border-style: dotted;
            text-decoration: none;
            border-color: #000000;"><p style="font-size: 5px">เงินที่เล่น</p></th>
        <th align="center" style="
            border-style: dotted;
            text-decoration: none;
            border-bottom: 1px;
            border-top: 1px;
            border-color: #000000;"><p style="font-size: 5px">เงินที่จ่าย</p></th>
    </tr>
    <?php
    $totalPlay = 0;
    $totalPay = 0;
    $lastKey = count($buyLottery) -1;
    foreach ($buyLottery as $key => $value) {
        $totalPlay += $value['moneyPlay'];
        $totalPay += $value['moneyPay'];
        ?>
        <tr>
            <td align="center" <?= $key === 0 ? 'style="padding-top: 3px;"' : '' ?>><p style="font-size: 5px"><?= $value['number']; ?></p></td>
            <td align="center" <?= $key === 0 ? 'style="padding-top: 3px;"' : '' ?>><p style="font-size: 5px"><?= $value['typeLottery']['name']; ?></p></td>
            <td align="center" <?= $key === 0 ? 'style="padding-top: 3px;"' : '' ?> <?= $key === $lastKey ? 'style="border-bottom: 1px solid #000000;"' : '' ?>><p style="font-size: 5px"><?= $value['moneyPlay']; ?></p></td>
            <td align="center" <?= $key === 0 ? 'style="padding-top: 3px;"' : '' ?> <?= $key === $lastKey ? 'style="border-bottom: 1px solid #000000;"' : '' ?>><p style="font-size: 5px"><?= $value['moneyPay']; ?></p></td>
        </tr>
    <?php } ?>
    <tr>
        <td align="center" <?= $key === $lastKey ? 'style="padding-top: 3px;"' : ''?>><p style="font-size: 5px">รวม</p></td>
        <td></td>
        <td align="center" <?= $key === $lastKey ? 'style="padding-top: 3px;"' : ''?>><p style="font-size: 5px; font-weight: bold" align="center"><?= $totalPlay ?></p></td>
        <td align="center" style="border-bottom: 1px solid #000000; <?= $key === $lastKey ? 'padding-top: 3px;' : ''?>"><p style="font-size: 5px"><?= $totalPay ?></p></td>
    </tr>
</table>

<table style="padding-top: 20px;">
    <tr>
        <td>
            <p style="font-size: 5px">ผู้ซื้อ: <?= $group->name === \backend\models\User::GROUP_NAME_USER ? $model->buyLottery->user->fullName : '.........................................'?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="font-size: 5px">ผู้ขาย: <?= $group->name === \backend\models\User::GROUP_NAME_SALE ? $model->buyLottery->user->fullName : '.......................................' ?></p>
        </td>
    </tr>
</table>


<table align="right">
    <tr>
        <td>
            <p style="font-size: 5px">เวลาพิมพ์: <?= date('Y-m-d H:i:s') ?></p>
        </td>
    </tr>
</table>