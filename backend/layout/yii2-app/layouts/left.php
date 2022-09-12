<?php
use yii\helpers\Url;
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="http://localhost/lottery_dev" class="site_title"><i class="fa fa-desktop"></i> <span>Backend Lottery</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?= Yii::$app->getUser()->identity->profileImage ?
                    Yii::getAlias('@web') . '/' . 'profile/' . Yii::$app->getUser()->identity->profileImage :
                    'http://placehold.it/128x128' ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info" align="center">
                <span>Welcome,</span>
                <h2><?= Yii::$app->user->identity->firstName . ' ' . Yii::$app->user->identity->lastName ?></h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3 align="center">General</h3>
                <?=
                \yiister\gentelella\widgets\Menu::widget(
                    [
                        "items" => [
                            ['label' => Yii::t('app', 'Menu'), 'options' => ['class' => 'header']],
                            
                            
                            
                            ['label' => Yii::t('app', 'Dashboards'), 'icon' => ' fa fa-tachometer', 'url' => '#',
                                'items' => [
                                    [
                                        'label' => Yii::t('app', 'Dashboard 1'),
                                        'icon' => ' fa fa-pie-chart',
                                        'url' => ['/site/index']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Dashboard 2'),
                                        'icon' => ' fa fa-pie-chart',
                                        'url' => ['/site/dashboard2']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Dashboard 3'),
                                        'icon' => ' fa fa-pie-chart',
                                        'url' => ['/site/dashboard3']
                                    ],
                                ],
                            ],
                            ['label' => Yii::t('app', 'Report'), 'icon' => ' fa fa-list', 'url' => '#',
                                'items' => [
                                    [
                                        'label' => Yii::t('app', 'Report Bill Lottery'),
                                        'icon' => ' fa fa-list-alt',
                                        'url' => ['/bill-lottery/index'],
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Report Lottery'),
                                        'icon' => ' ffa fa-list-ul',
                                        'url' => ['/report-lottery/index'],
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Report Number By Lottery'),
                                        'icon' => ' fa fa-list-ol',
                                        'url' => ['/report-lottery/number'],
                                    ],
                                ],
                            ],
                            
                             
                            
                            ['label' => Yii::t('app', 'Manage Content'), 'icon' => ' fa-cogs', 'url' => '#',
                                'items' => [
                                    ['label' => Yii::t('app', 'Manage Information'), 'icon' => ' fa-info-circle', 'url' => ['/information/index'], 'visible' => Yii::$app->user->can('manageInformation')],
                                    ['label' => Yii::t('app', 'Manage Home'), 'icon' => ' fa-bullhorn', 'url' => ['/information/update?id=6']],
                                    ['label' => Yii::t('app', 'Manage Announce'), 'icon' => ' fa-bullhorn', 'url' => ['/information/update?id=2']],
                                    ['label' => Yii::t('app', 'Manage Manual'), 'icon' => ' fa-book', 'url' => ['/information/update?id=3']],
                                    ['label' => Yii::t('app', 'Manage Contact Us'), 'icon' => ' fa-address-card-o', 'url' => ['/information/update?id=1']],


                                ],
                            ],


                            ['label' => Yii::t('app', 'Manage Promotion'), 'icon' => ' fa-tags', 'url' => '#',
                                'items' => [
                                    [
                                        'label' => Yii::t('app', 'Promotion Normal'),
                                        'icon' => '#',
                                        'url' => ['/information/update?id=4']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Promotion Agent'),
                                        'icon' => '#',
                                        'url' => ['/information/update?id=5'],
                                    ],
                                ],
                            ],
                            ['label' => Yii::t('app', 'Manage Lottery'), 'icon' => ' fa-money', 'url' => ['/lottery-period/index']],
                            ['label' => Yii::t('app', 'Manage Football'), 'icon' => ' fa fa-soccer-ball-o', 'url' => ['/league-football/index']],
                            ['label' => Yii::t('app', 'Manage Accounts'), 'icon' => ' fa fa-bank', 'url' => ['/bank/index']],
                            ['label' => Yii::t('app', 'Issue'), 'icon' => ' fa fa-info-circle', 'url' => ['/issue/index']],
                            ['label' => Yii::t('app', 'Manage Menu'), 'icon' => ' fa-th', 'url' => ['/menu/index'], 'visible' => Yii::$app->user->can('manageMenu')],
                            ['label' => Yii::t('app', 'Setting'), 'icon' => ' fa-cog', 'url' => '#', 'visible' => Yii::$app->user->can('manageSetting'),
                                'items' => [
                                    [
                                        'label' => Yii::t('app', 'User'),
                                        'icon' => ' fa-user',
                                        'url' => ['/user/index']
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Manage Group'),
                                        'icon' => ' fa-group',
                                        'url' => ['/group/index'],
                                    ],
                                    [
                                        'label' => Yii::t('app', 'Manage User Group'),
                                        'icon' => ' fa-user-plus',
                                        'url' => ['/user-group/index'],
                                    ],
                                ],
                            ],
                        ],
                    ]
                )
                ?>
            </div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a href="<?= Url::to(['site/logout']) ?>" data-method="post" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>