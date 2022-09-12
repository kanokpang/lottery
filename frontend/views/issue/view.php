<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Issue */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= $this->title ?></span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'description:html',
                    'createdAt',
                    'updatedAt',
                ],
            ]) ?>
        </div>
    </div>
</div>

<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Answer Issue') ?></span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <?php foreach ($answerDescription as $answer) { ?>
                <div class="item">
                    <div class="item-head">
                        <div class="item-details">
                            <?php if (Yii::$app->authManager->checkAccess($answer->createdBy, '4') ||
                            Yii::$app->authManager->checkAccess($answer->createdBy, '5')) { ?>
                                <img class="item-pic rounded" style="height: 35px;" src="<?= $answer->user->profileImage ? Url::to('@web/profile/'.$answer->user->profileImage) : Yii::getAlias('@web/img/avatar-small.jpg')?>">
                                <span style="color: blue"><?= $answer->user->username ?></span>
                            <?php } else { ?>
                                <img class="item-pic rounded" style="height: 35px;" src="<?= $answer->user->profileImage ? Url::base() . '/../../' . Yii::$app->urlManagerBackend->baseUrl . '/profile/'.$answer->user->profileImage : Yii::getAlias('@web/img/avatar-small.jpg')?>">
                                <span style="color: red"><?= $answer->user->username ?></span>
                            <?php } ?>
                            <span class="item-label" style="float: right"><?= $answer->createdAt ?></span>
                        </div>
                        <span class="item-status">
                        <?= $answer->description ?>
                    </span>
                    </div>
                </div>
                <hr>
            <?php } ?>
        </div>
    </div>
</div>


<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Create Answer Issue') ?></span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="tab-content">

            <?= $this->render('_formAnswer', [
                'model' => $answerIssue
            ]); ?>
        </div>
    </div>
</div>
