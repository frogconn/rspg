<?php

namespace app\controllers;

use Yii;
use app\Models\Micro;
use app\Models\Type;
use app\Models\ResearchZone;

class MicroController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
	
	
	public function actionCreate(){
		$micro = new  Micro();
		$type = new Type();
		$zone = new ResearchZone();
		
	return $this->render('create', [
		'micro' => $micro,
		'type'  => $type,
		'zone'  => $zone	
	]); 
	}
	

		
		
	}
	
	
  
