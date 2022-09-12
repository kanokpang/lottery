<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AnswerIssue */

$this->title = Yii::t('app','Create Answer Issue');
$this->params['breadcrumbs'][] = ['label' => 'Answer Issues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-issue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
