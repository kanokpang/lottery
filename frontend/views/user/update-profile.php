<?php

use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;

?>
<?= $this->render('left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<div class="profile-content">
    <?php if(Yii::$app->session->hasFlash('alert')):?>
        <?= Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ])?>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <?= $this->render('tab-x') ?>
                </div>
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <span class="caption-subject font-red bold uppercase">แก้ไขโปรไฟล์: <?= $model->fullName ?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?= $this->render('_formUser', [
                        'model' => $model,
                        'listData' => $listData,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>