<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ConditionLottery */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Condition Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title; ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'lottery.name',
        'typeLottery.name',
        'name',
        'number',
        'condition',
        'limit',
        [
            'label' => Yii::t('app', 'Is Purchase'),
            'value' => function ($model) {
                return $model->isPurchaseLimit ? Yii::t('app', Yii::t('app', 'Purchase Limit'))
                    : Yii::t('app', 'Not for sale');
            }
        ],
        'createdAt',
        'updatedAt',
    ],
]) ?>
