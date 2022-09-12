<?php

use backend\models\UserGroup;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $level integer */

$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<p>
    <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => Yii::t('app', 'Full Name'),
                'options' => ['width' => '130px'],
                'value' => 'fullName',
            ],
            [
                'attribute' => 'username',
                'options' => ['width' => '80px'],
            ],
            'email:email',
            [
                'attribute' => 'groupId',
                'label' => Yii::t('app', 'Group Name'),
                'format' => 'html',
                'filter' => \yii\helpers\ArrayHelper::map(\backend\models\Group::find()->all(), 'id', 'name'),
                'value' => function ($model) {
                    $groups = UserGroup::find()->select(['name', 'groupId'])->joinWith(['groupName'])->where(['userId' => $model->id])->asArray()->all();
                    $groupName = '';
                    if ($groups) {
                        foreach ($groups as $key => $group) {
                            $groupName .= '<p>' . $group['name'] . '</p>';
                        }
                    } else {
                        $groupName = 'ไม่มีกลุ่ม';
                    }
                    return $groupName;
                }
            ],
            [
                'label' => Yii::t('app', 'Name Bank'),
                'value' => 'bank.name',
            ],
            [
                'attribute' => 'numberBank',
                'options' => ['width' => '150px'],
            ],
            'birthDate',
            'mobile',
            'lineId',
            'referCode',
            'referenceReferCode',
            [
                'label' => Yii::t('app', 'Status'),
                'value' => function ($model) {
                    return \yii\helpers\ArrayHelper::getValue($model->getItemStatus(), $model->status);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'template' => '<div class="btn-group btn-group-sm text-center" role="group">{view}{update}{delete}{update-status}{generate}</div>',
                'buttons' => [
                    'delete' => function ($url, $model, $key) {
                        return Html::a(!$model->enabled ? '<i class="glyphicon glyphicon-repeat"></i>' : '<i class="glyphicon glyphicon-trash"></i>', $url, [
                            'class' => 'btn btn-default',
                            'title' => $model->enabled ? Yii::t('app', 'Delete') : Yii::t('app', 'Restore'),
                            'data-confirm' => $model->enabled ? Yii::t('yii', 'Are you sure to delete this item?') : Yii::t('yii', 'Are you sure to restore this item?'),
                            'data-method' => 'post',
                        ]);
                    },
                    'update-status' => function ($url, $model, $key) {
                        return Html::a(Yii::t('app','Status'), $url, [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app', 'Edit Status'),
                        ]);
                    },
                    'generate' => function ($url, $model, $key) {
                        $url = [
                            'user/generate',
                            'id' => $model->id,
                        ];
                        return Html::a(Yii::t('app','Generate'), $url, [
                            'class' => 'btn btn-default',
                            'title' => Yii::t('app', 'Generate'),
                            'data' => ['method' => 'post'],
                        ]);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
