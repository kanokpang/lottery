<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 11/3/2561
 * Time: 13:10
 */

use yii\grid\GridView;

?>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'typeLottery.name',
            'payment',
        ],
    ]); ?>
</div>
