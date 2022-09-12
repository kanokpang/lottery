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
<div class="x_panel">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            [
               'label' => Yii::t('app', 'Full Name'),
               'value' => function ($model) {
                return $model->user->fullName;
               }
            ],
            'createdAt',
            'updatedAt',
        ],
    ]) ?>

</div>

<div class="x_panel">
    <h4><i class="fa fa-newspaper-o font-green-meadow"></i><?= Yii::t('app', 'Answer Issue') ?></h4>
    <div class="tab-content">
        <?php foreach ($answerDescription as $answer) { ?>
            <div class="item">
                <div class="item-head">
                    <div class="item-details">
                        <?php if (Yii::$app->authManager->checkAccess($answer->createdBy, '4') ||
                            Yii::$app->authManager->checkAccess($answer->createdBy, '5')) { ?>
                            <img class="item-pic rounded" style="height: 35px; border-radius: 50%!important;" src="<?= $answer->user->profileImage ? Url::base() . '/../../' . Yii::$app->urlManagerFrontend->baseUrl . '/profile/'.$answer->user->profileImage : Yii::getAlias('@web/img/avatar-small.jpg')?>">
                            <span style="color: red"><?= $answer->user->username ?></span>
                        <?php } else { ?>
                            <img class="item-pic rounded" style="height: 35px; border-radius: 50%!important;" src="<?= $answer->user->profileImage ? Url::to('@web/profile/'.$answer->user->profileImage) : Yii::getAlias('@web/img/avatar-small.jpg')?>">
                            <span style="color: blue"><?= $answer->user->username ?></span>
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

<div class="x_panel">
    <?= $this->render('/answer-issue/create', [
            'model' => $answerIssue,
    ]) ?>
</div>
