<?php

namespace console\controllers;

// at top with your other use

use Yii;
use yii\filters\AccessControl;
use app\models\PermissionHelpers;

use yii\helpers\Console;

class RbacController extends \yii\console\Controller {
    // first function inside the class
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'only' => ['privateaction1', 'privateaction2'],
            'rules' => [
                [
                    'actions' => ['privateaction1', 'privateaction2'],
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function($rule, $action) {
                            return PermissionHelpers::requireAdmin();
                        }
                ],
            ],
        ],
}

  public function actionInit(){
     Console::output('Yii 2 Learning.');
  }

}
?>