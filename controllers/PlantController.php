<?php

namespace app\controllers;
use Yii;
use app\Models\Plant;
use app\Models\Type;
use app\Models\ResearchZone;

class PlantController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actionCreate()
	{
		$type = new Type();
		$plant = new Plant();
		$zone = new ResearchZone();
	
	return $this-> render('create' , [
		'type' => $type,
		'plant' => $plant,
		'zone' => $zone
	]);
	}
}
