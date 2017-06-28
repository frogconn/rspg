<?php

namespace console\controllers;

// at top with your other use

use Yii;
use yii\filters\AccessControl;
use app\models\PermissionHelpers;

use yii\helpers\Console;

class HelloController extends Controller {
    // first function inside the class


  public function actionInit(){
     Console::output('Yii 2 Learning.');
  }

}

?>