<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create Group'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'showFrontend',
                'value' => function ($model) {
                    return $model->showFrontend ? Yii::t('app', 'Show') : Yii::t('app', 'Not Show');
                }
            ],
            [
                'attribute' => 'enabled',
                'value' => function ($model) {
                    return $model->enabled ? Yii::t('app', 'Enabled') : Yii::t('app', 'Un Enabled');
                }
            ],
            [
                'attribute' => 'permission',
                'format' => 'html',
                'value' => function ($model) {
                    $auth = Yii::$app->authManager;
                    $children = $auth->getChildren($model->id);
                    $permissions = ArrayHelper::map($children, 'name', 'name');
                    $textPermission = '<ul type="circle">';
                    foreach ($permissions as $permission) {
                        $textPermission .= '<li>' . $permission . '</li>';
                    }
                    $textPermission .= '</ul>';
                    return $textPermission;
                }
            ],
            'createdAt',
            'updatedAt',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{managePermission}{update}{delete}</div>',
                'buttons' => [
                    'managePermission' => function ($url, $model) {
                        $title = Yii::t('app', 'Manage Permission');
                        $url = ['group/manage-permission', 'id' => $model->id];
                        return Html::a($title, $url, ['class' => 'btn btn-default']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a(!$model->enabled ? '<i class="glyphicon glyphicon-repeat"></i>' : '<i class="glyphicon glyphicon-trash"></i>', $url, [
                            'class' => 'btn btn-default',
                            'title' => $model->enabled ? Yii::t('app', 'Delete') : Yii::t('app', 'Restore'),
                            'data-confirm' => $model->enabled ? Yii::t('yii', 'Are you sure to delete this item?') : Yii::t('yii', 'Are you sure to restore this item?'),
                            'data-method' => 'post',
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>