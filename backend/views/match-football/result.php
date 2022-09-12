<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/29/2018
 * Time: 9:11 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

$this->title = $model->team1->name . ' - ' . $model->team2->name;
?>
<h2><?= Yii::t('app','Result Football') ?></h2>
<?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-12">
        <h2><?= $this->title; ?></h2>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'label' => Yii::t('app', 'Event'),
                    'value' => function ($model) {
                        return $model->league->name;
                    }
                ],
                [
                    'label' => Yii::t('app', 'Team Home'),
                    'value' => function ($model) {
                        return $model->team1->name;
                    }
                ],
                [
                    'label' => Yii::t('app', 'Team Away'),
                    'value' => function ($model) {
                        return $model->team2->name;
                    }
                ],
                'scoreTeam1',
                'scoreTeam2',
                'startMatch',
                'endMatch',
                'startBuy',
                'endBuy',
                'hdpFirstTime',
                'homeFirstTime',
                'awayFirstTime',
                'goalFirstTime',
                'overFirstTime',
                'underFirstTime',
                'hdpFullTime',
                'homeFullTime',
                'awayFullTime',
                'goalFullTime',
                'overFullTime',
                'underFullTime',
                'createdAt',
                'updatedAt',
            ],
        ]) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($resultFootball, 'teamWinByMatchId')->radioList([
            1 => $model->team1->name,
            2 => $model->team2->name
        ]); ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($resultFootball, 'type')->checkboxList([
            1 => Yii::t('app', 'HDP'),
            2 => Yii::t('app', 'Over'),
            3 => Yii::t('app', 'HxA'),
        ])?>
    </div>
    <div class="col-md-12">
        <?= $form->field($resultFootball, 'isFullTime')->radioList([
            1 => Yii::t('app', 'Full Time'),
            0 => Yii::t('app', 'First Time')
        ])->label(Yii::t('app', 'Full Time / First Time'))?>
    </div>
    <div class="form-group col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
