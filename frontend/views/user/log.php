<div class="portlet light">
    <div class="portlet-body">
        <p class="text-danger">*หากพบสิ่งผิดปกติ กรุณาเปลี่ยนรหัสผ่านหรือติดต่อทีมงานโดยทันที และเราเก็บย้อนหลังสูงสุด 7
            วัน</p></div>
    <div class="alert alert-success">
        <strong>ข้อมูลตอนนี้ของคุณคือ</strong> IP: <?= getHostByName(getHostName()); ?>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-light">
            <thead>
            <tr class="uppercase">
                <th><?= Yii::t('app', 'IP') ?></th>
                <th><?= Yii::t('app', 'Status') ?></th>
                <th><?= Yii::t('app', 'Time') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($userLogs as $userLog) { ?>
                <tr class="text-success">
                    <td><?= $userLog->ipAddress ?></td>
                    <td><?= $userLog->status === 1 ?
                            Yii::t('app', 'Login') :
                            Yii::t('app', 'Logout') ?>
                    </td>
                    <td><?= $userLog->createdAt ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="table-paginate">

        </div>
    </div>
</div>