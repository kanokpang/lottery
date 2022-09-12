<div class="portlet-body">
    <div class="tab-content">
        <div class="tab-pane active" id="personal_info">
            <div class="form-group">
                <label class="control-label text-success">Username</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->username ?>">
            </div>
            <div class="form-group">
                <label class="control-label text-success">อีเมล์</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->email ?>">
            </div>
            <div class="form-group">
                <label class="control-label text-success">ชื่อจริง - นามสกุล</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->firstName. ' '. $model->lastName?>">
            </div>
            <div class="form-group">
                <label class="control-label text-success">เบอร์โทร</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->mobile ?>">
            </div>
            <div class="form-group">
                <label class="control-label text-success">line Id</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->lineId ?>">
            </div>
            <div class="form-group">
                <label class="control-label text-success">สมัครเมื่อ</label>
                <input type="text" class="form-control" disabled="" value="<?= $model->createdAt ?>">
            </div>


            <div class="clearfix margin-top-10">
                <span class="label label-danger">หมายเหตุ! </span>
                <span>&nbsp;เสียใจด้วย คุณไม่สามารถแก้ไขข้อมูลใดๆได้ กรุณาติดต่อแอดมินหากคุณมีปัญหากับข้อมูลของคุณหรือคุณต้องการแก้ไขมัน </span>
            </div>
        </div>
    </div>
</div>