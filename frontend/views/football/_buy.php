<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(); ?>

<?php if ($selectedTeam && $type === '1') {
    if ($selectedTeam->isSecondTeam === 1) {
        $hdp = $rate === '1' ? $selectedTeam->hdpFirstTime : $selectedTeam->hdpFullTime;
        $team1 = $selectedTeam->team1->name . '(-' . $hdp . ')';
    } else {
        $hdp = $rate === '1' ? $selectedTeam->hdpFirstTime : $selectedTeam->hdpFullTime;
        $team1 = $selectedTeam->team1->name . '(+' . $hdp . ')';
    }
    if ($selectedTeam->isSecondTeam === 2) {
        $hdp = $rate === '1' ? $selectedTeam->hdpFirstTime : $selectedTeam->hdpFullTime;
        $team2 = $selectedTeam->team2->name . '(-' . $hdp . ')';
    } else {
        $hdp = $rate === '1' ? $selectedTeam->hdpFirstTime : $selectedTeam->hdpFullTime;
        $team2 = $selectedTeam->team2->name . '(+' . $hdp . ')';
    }
} elseif ($selectedTeam && $type === '2') {
    if ($teamId === '1') {
        $textOver = $rate === '1' ? $selectedTeam->rangeOverFirstTime : $selectedTeam->rangeOverFullTime;
        $team1 = $selectedTeam->team1->name . '(' . $textOver . ')';
    } else {
        $textUnder = 'U';
        $team2 = $selectedTeam->team2->name . '(' . $textUnder . ')';
    }
} elseif ($selectedTeam && $type === '3') {
    if ($teamId === '1') {
        $team1 = $selectedTeam->team1->name;
    } elseif ($teamId === '2') {
        $team2  = $selectedTeam->team2->name;
    } else {
        $draw = 'DRAW';
    }
}
if ($selectedTeam && $type) {
    if ($teamId === '1') {
        $model->teamWinByMatchId = $team1;
    } elseif ($teamId === '2') {
        $model->teamWinByMatchId = $team2;
    } else {
        $model->teamWinByMatchId = $draw;
    }
    echo $form->field($model, 'teamWinByMatchId')->textInput(['maxlength' => true, 'disabled' => true]);
}
?>

<?php if ($rate && $type === '1') {
    if ($teamId === '1') {
        $model->rate = $rate === '1' ? $selectedTeam->homeFirstTime : $selectedTeam->homeFullTime;
    } else {
        $model->rate = $rate === '1' ? $selectedTeam->awayFirstTime : $selectedTeam->awayFullTime;
    }
} elseif ($rate && $type === '2') {
    if ($teamId === '1') {
        $model->rate = $rate === '1' ? $selectedTeam->overFirstTime : $selectedTeam->overFullTime;
    } else {
        $model->rate = $rate === '1' ? $selectedTeam->underFirstTime : $selectedTeam->underFullTime;
    }
} elseif ($rate && $type === '3') {
    if ($teamId === '1') {
        $model->rate = $rate === '1' ? $selectedTeam->homeWinFirstTime : $selectedTeam->homeWinFullTime;
    } elseif ($teamId === '2') {
        $model->rate = $rate === '1' ? $selectedTeam->awayWinFirstTime : $selectedTeam->awayWinFullTime;
    } else {
        $model->rate = $rate === '1' ? $selectedTeam->drawWinFirstTime : $selectedTeam->drawWinFullTime;
    }
}
if ($rate && $type) {
    echo $form->field($model, 'rate')->textInput(['maxlength' => true, 'disabled' => true]);
}
?>

<?= $form->field($model, 'moneyPlay')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>