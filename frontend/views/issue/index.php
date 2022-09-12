<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IssueSearch *//* @var $dataProvider yii\data\ActiveDataProvider */;
?>
<?= $this->render('/user/left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase"> ขอความช่วยเหลือ </span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="<?= Url::to(['issue/index']) ?>">ขอความช่วยเหลือ</a>
                        </li>
                        <li>
                            <a href="<?= Url::to(['issue/create']) ?>">เพิ่มหัวข้อ</a>
                        </li>
                    </ul>
                </div>
                <?php foreach ($issues as $issue) { ?>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <div class="mt-comments">
                                <div class="mt-comment">
                                    <a href="<?= Url::to(['issue/view', 'id' => $issue->id])?>"
                                       class="text-decoration-none">
                                        <div class="mt-comment-body padding-none">
                                            <div class="mt-comment-info">
                                                <span class="mt-comment-author font-blue-dark">
                                                    <?= $issue->name ?>
                                                </span>
                                                <span class="mt-comment-date"><?= $issue->createdAt ?></span>
                                            </div>
                                            <div class="mt-comment-text"><?= $issue->description ?></div>
                                            <div align="right">
                                                Status: <span style="color: <?= $issue->status ? 'red' : 'green' ?>"><?= $issue->status ? Yii::t('app', 'Open') : Yii::t('app', 'Close')?></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
