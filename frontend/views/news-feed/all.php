<?php

use backend\models\CommentFeedNews;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Alert;

?>
<?= $this->render('/user/left-profile', [
    'model' => $model,
    'userGroup' => $userGroup,
]); ?>
<?php if (Yii::$app->session->hasFlash('alert')): ?>
    <?= Alert::widget([
        'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
        'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
    ]) ?>
<?php endif; ?>
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <i class="fa fa-newspaper-o font-green-meadow"></i>
                        <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Feed News Last') ?></span>
                    </div>
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="<?= Url::to(['/news-feed/index']) ?>"> ของฉัน </a>
                        </li>
                        <li class="active">
                            <a href="<?= Url::to(['/news-feed/all']) ?>"> ทั้งหมด </a>
                        </li>
                    </ul>
                </div>
                <div class="portlet-body">
                    <div class="tab-content">
                        <div class="tab-pane active">
                            <?php foreach ($newsFeeds as $newsFeed) { ?>
                            <div class="mt-comments">
                                <div class="mt-comment padding-left-none padding-right-none">
                                    <div class="mt-comment-img">
                                        <img src="<?= $newsFeed->user->profileImage ?
                                            Url::to('@web/profile/'.$newsFeed->user->profileImage) :
                                            Url::to('@web/img/avatar-small.jpg') ?>" width="45px" height="45px">
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <span class="mt-comment-author"><?= $newsFeed->user->fullName ?></span>
                                            <span class="mt-comment-date margin-right-5"><a href="javascript:void(0)" onclick="createSubComment(<?= $newsFeed->id ?>)"><i class="fa fa-pencil"></i><?= Yii::t('app', 'Comment')?></a></span>
                                            <span class="mt-comment-date margin-right-11">
                                                <a href="<?= Url::to(['/news-feed/view', 'id' => $newsFeed->id]) ?>">
                                                    <i class="fa fa-search"></i><?= Yii::t('app', 'View')?>
                                                </a>
                                            </span>
                                            <span class="mt-comment-date margin-right-10" title="<?= $newsFeed->createdAt ?>"><i class="fa fa-clock-o"></i><?= $newsFeed->createdAt ?>
                                            </span>
                                            <span class="mt-comment-date margin-right-10">
                                                    <?php
                                                    $commentFeedNewsObjs = CommentFeedNews::findAll(['feedNewsId' => $newsFeed->id]);
                                                    ?>
                                                    <i class="fa fa-comments"></i><?= count($commentFeedNewsObjs) ?>
                                                </span>
                                        </div>
                                        <div class="mt-comment-text">
                                            <?= $newsFeed->description ?>
                                        </div>
                                        <div id="create-sub-comment-<?= $newsFeed->id ?>"></div>
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
                            <?php } ?>
                        </div>
                    </div>
                    <div id="template-create-sub-comment" class="display-hide">
                        <h5 class="sbold">แสดงความคิดเห็น</h5>
                        <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($commentFeedNews, 'description')->textarea(['rows' => '6']) ?>
                        <?= $form->field($commentFeedNews, 'feedNewsId')->textInput([''])->hiddenInput()->error(false)->label(false) ?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Post'), ['class' => 'btn btn-success uppercase btn-md sbold']) ?>
                            <?= Html::submitButton(Yii::t('app', 'Cancel'), ['class' => 'btn btn-danger uppercase btn-md sbold btn-cancel']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>