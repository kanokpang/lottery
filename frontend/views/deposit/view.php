<?php
/**
 * Created by PhpStorm.
 * User: EOFFICE3
 * Date: 5/5/2018
 * Time: 1:11 PM
 */

use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-newspaper-o font-green-meadow"></i>
            <span class="caption-subject font-green-meadow bold uppercase"><?= Yii::t('app', 'Note Transfer Money') ?></span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => Yii::t('app', 'Account Name'),
                            'value' => function ($model) {
                                return $model->bankOwner->name;
                            }
                        ],
                        [
                            'label' => Yii::t('app', 'Number Bank'),
                            'value' => function ($model) {
                                return $model->bankOwner->number;
                            }
                        ],
                        'money',
                        [
                            'attribute' => 'status',
                            'value' => function ($model) {
                                if ($model->status === 0) {
                                    $status = Yii::t('app', 'Padding');
                                } elseif ($model->status === 1) {
                                    $status = Yii::t('app', 'Complete');
                                } elseif ($model->status === 2) {
                                    $status = Yii::t('app', 'Cancel');
                                }
                                return $status;
                            }
                        ],
                        'transactionNumber',
                        'transactionDate',
                        [
                            'label' => Yii::t('app', 'Chanel Bank'),
                            'value' => function ($model) {
                            return $model->chanelBank->name;
                            },
                        ],
                        'createdAt',
                    ],
                ]);
                ?>
                <?= DetailView::widget([
                    'model' => $noteTransferMoney,
                    'attributes' => [
                        'note',
                        [
                            'attribute' => 'photos',
                            'value' => Url::base() . '/../../' . Yii::$app->urlManagerBackend->baseUrl . '/uploads/' . $noteTransferMoney->photos,
                            'format' => ['image', ['style' => 'max-width:25%']],
                        ],
                    ],
                ]);
                ?>

            </div>
        </div>
    </div>
</div>
