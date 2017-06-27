<?php

namespace app\controllers;

use Yii;

use app\models\Plant;
use app\models\PlantSearch;
use app\models\Type;
use app\models\Zone;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;


/**
 * AnimalController implements the CRUD actions for Animal model.
 */
class PlantController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Plant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PlantSearch();
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
        $model = new Plant();
		$zone = new Zone();
		$type = new Type();

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $model->zone_id = $_POST['Zone']['zone_name'];
            $model->type_id = $_POST['Type']['type_name'];
            $model->save();
            return $this->redirect(['plant/index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'zone' => $zone,
				'type' => $type
            ]);
        }
    }
	
	
	public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $zone = $this->findZone($model->zone_id);
        $type = $this->findType($model->type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            $model->zone_id = $_POST['Zone']['zone_name'];
            $model->type_id = $_POST['Type']['type_name'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->plant_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'zone' => $zone,
                'type' => $type,
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
        if (($model = Plant::findOne($id)) !== null) {
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

    protected function findType($id){
        if (($model = Type::findOne($id)) != null) {
            return $model;
        } else {
            print_r($model);
            throw new NotFoundHttpException('The requested page, Zone does not exist.');
        }
    }
}

	
