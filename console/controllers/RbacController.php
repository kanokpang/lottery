<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

class RbacController extends Controller
{
    const PERMISSION_MANAGE_FRONTEND = 'manageFrontend';
    const PERMISSION_MANAGE_BACKEND = 'manageBanckend';
    const PERMISSION_MANAGE_SETTING = 'manageSetting';
    const PERMISSION_MANAGE_MENU = 'manageMenu';
    const PERMISSION_MANAGE_INFORMATION = 'manageInformation';

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Remove! RBAC roles has been success.');

        // add "createPost" permission
        $manageFrontend = $auth->createPermission(self::PERMISSION_MANAGE_FRONTEND);
        $manageFrontend->description = 'Manage Frontend';
        $auth->add($manageFrontend);

        // add "updatePost" permission
        $manageBanckend = $auth->createPermission(self::PERMISSION_MANAGE_BACKEND);
        $manageBanckend->description = 'Manage Banckend';
        $auth->add($manageBanckend);

        $manageSetting = $auth->createPermission(self::PERMISSION_MANAGE_SETTING);
        $manageSetting->description = 'Manage Settinge';
        $auth->add($manageSetting);

        $manageMenu = $auth->createPermission(self::PERMISSION_MANAGE_MENU);
        $manageMenu->description = 'Manage Menu';
        $auth->add($manageMenu);

        $manageInformation = $auth->createPermission(self::PERMISSION_MANAGE_INFORMATION);
        $manageInformation->description = 'Manage Information';
        $auth->add($manageInformation);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageFrontend);
        $auth->addChild($admin, $manageBanckend);
        $auth->addChild($admin, $manageSetting);
        $auth->addChild($admin, $manageMenu);
        $auth->addChild($admin, $manageInformation);
        //////
        $groupId1 = $auth->createRole('1');
        $groupId2 = $auth->createRole('2');
        $groupId3 = $auth->createRole('3');
        $groupId4 = $auth->createRole('4');
        $groupId5 = $auth->createRole('5');
        $auth->add($groupId1);
        $auth->add($groupId2);
        $auth->add($groupId3);
        $auth->add($groupId4);
        $auth->add($groupId5);


        $auth->assign($admin, 1);

        Console::output('Success! RBAC roles has been added.');
    }
}