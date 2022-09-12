<?php
use yii\helpers\Url;
?>
<div class="portlet light portlet-fit ">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject font-red bold uppercase">แทงหวยรัฐบาล</span>
        </div>
        <div class="actions">
            <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title=""
               title=""> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-4" id="server_63053">
                <div class=" bg-green-jungle bg-font-green-jungle server-now    mt-element-ribbon ">
                    <h5 class="margin-none text-center dot-dot-dot  bold " title="<?= $lottery[0]['name']; ?>">
                        <?= $lottery[0]['name']; ?></h5>
                    <hr class="margin-bottom-10 margin-top-10">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>
                            วันที่และเวลาเริ่มรับ: <?= $lottery[0]['startDateTime'] ?>
                        </li>
                        <li class="list-group-item">
                            <i class="fa fa-calendar"></i>
                            วันที่และเวลาปิดรับ: <?= $lottery[0]['endDateTime'] ?>
                        </li>
                    </ul>
                    <a href="<?= Url::to(['lottery/promotion', 'id' => $lottery[0]['id']]) ?>"
                       class="btn  grey-cararra  btn-block ">เข้าแทงหวย</a>
                </div>
            </div>
        </div>
    </div>
</div>