<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Add User Group'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.fullName',
            'group.name',
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttonOptions' => ['class' => 'btn btn-default'],
            ],
        ],
    ]); ?>
</div>