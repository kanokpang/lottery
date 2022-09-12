<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WalletUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Wallet Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can($permissionName)) { ?>
        <p>
            <?= Html::a('Create Wallet User', ['/wallet-user/create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>
    <?php Pjax::begin(['id' => 'wallet-user']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.fullName',
            [
                'attribute' => 'total',
                'format' => ['decimal', 2]
            ],
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{delete}</div>',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'visibleButtons' => [
                    'view' => Yii::$app->user->can($permissionName),
                    'update' => Yii::$app->user->can($permissionName),
                    'delete' => Yii::$app->user->can($permissionName),
                ],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/wallet-user/view', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $url, ['class' => 'btn btn-default']);
                    },
                    'update' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/wallet-user/update', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['class' => 'btn btn-default']);
                    },
                    'delete' => function ($url, $model, $key) {
                        $url = \yii\helpers\Url::to(['/wallet-user/delete', 'id' => $model->id]);
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, ['class' => 'btn btn-default',
                            'data' => ['method' => 'post']]);
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
