<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Remove all existing roles, permissions
        $auth->removeAll();

        // Create roles
        $admin = $auth->createRole('admin');
        $employee = $auth->createRole('employee');

        // Add roles to the system
        $auth->add($admin);
        $auth->add($employee);

        // Create permissions
        $manageUsers = $auth->createPermission('manageUsers');
        $viewOwnProfile = $auth->createPermission('viewOwnProfile');

        // Add permissions to the system
        $auth->add($manageUsers);
        $auth->add($viewOwnProfile);

        // Assign permissions to roles
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($employee, $viewOwnProfile);

        // Assign roles to users (replace with actual user IDs)
        $auth->assign($admin, 1); // 1 is the user ID of the admin user
        $auth->assign($employee, 2); // 2 is the user ID of the employee user
    }
}
