<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<div class="table-responsive">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.fullName',
            'ipAddress',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->status === 1 ? Yii::t('app', 'Login') : Yii::t('app', 'Logout');
                }
            ],
            'createdAt',
        ],
    ]); ?>
</div>
