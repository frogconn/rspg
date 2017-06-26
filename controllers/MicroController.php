<?php

namespace app\controllers;

use Yii;
use app\Models\Micro;
use app\Models\Type;
use app\Models\ResearchZone;
use app\Models\MicroSearch;
use yii\filters\VerbFilter;

class MicroController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
	
    public function actionIndex()
    {
        $searchModel = new MicroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
			 ]);
    }
		
	 public function actionCreate()
    {
        $micro = new Micro();
		$type = new Type();
		$zone = new ResearchZone ();

        if ($micro->load(Yii::$app->request->post()) && $micro->save(false)) {
            $micro->type_id = $_POST['Type']['type_name'];
			$micro->zone_id = $_POST['ResearchZone']['zone_name'];
            $micro->save();
            return $this->redirect(['micro/index']);
            //return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('create', [
                'micro' => $micro,
                'type' => $type,
				'zone' => $zone,
            ]);
        }
    }
	
	public function actionUpdate($id)
    {
        $micro = $this->findModel($id);
		$type = $this->findModel($micro->type_id);
		$zone = $this->findModel($micro->zone_id);

        if ($micro->load(Yii::$app->request->post()) && $micro->save()) {
            return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('update', [
                'micro' => $micro,
				'type'  => $type,
				'zone'  => $zone,
            ]);
        }
    }
	public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
		
	 protected function findModel($id)
    {
        if (($model = Micro::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	protected function findZone($id){
        if (($model = Zone::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, Zone does not exist.');
        }
    }
	

		
		
	}
	
	
  
