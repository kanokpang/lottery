<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Issue */

$this->title = 'Create Issue';
$this->params['breadcrumbs'][] = ['label' => 'Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="<?= Url::to(['issue/index']) ?>">ขอความช่วยเหลือ</a>
                        </li>
                        <li class="active">
                            <a href="<?= Url::to(['issue/create']) ?>">เพิ่มหัวข้อ</a>
                        </li>
                    </ul>
                    <div class="caption">
                        <span class="caption-subject font-red bold uppercase"><?= Yii::t('app', 'Create Issue') ?></span>
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
