<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Issue */

$this->title = Yii::t('app','Update Issue: ' . $model->name);
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?= $this->render('/user/left-profile', [
    'model' => $user,
    'userGroup' => $userGroup,
]); ?>
<div class="profile-content">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption">
                        <span class="caption-subject font-red bold uppercase"><?= $this->title ?></span>
                    </div>
                </div>
                <div class="portlet-body notification">
                    <?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
