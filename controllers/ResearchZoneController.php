<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;

use app\models\ResearchZone;
use app\models\ResearchZoneSearch;
use app\models\Province;
use app\models\Amphur;
use app\models\District;
use app\models\Region;

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * ResearchZoneController implements the CRUD actions for ResearchZone model.
 */
class ResearchZoneController extends Controller
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
     * Lists all ResearchZone models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResearchZoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResearchZone model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ResearchZone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResearchZone();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ResearchZone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ResearchZone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResearchZone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResearchZone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResearchZone::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	// new code here
	public function actionGetAmphur()
	{
		$out = [];
		if (isset($_POST['depdrop_parents'])) 
		{
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) 
			{
				$province_id = $parents[0];
				$out = $this->getAmphur($province_id);
				echo Json::encode(['output'=>$out, 'selected'=>'']);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	public function actionGetDistrict()
	{
		$out = [];
		if (isset($_POST['depdrop_parents'])) 
		{
			$ids = $_POST['depdrop_parents'];
			$province_id = empty($ids[0]) ? null : $ids[0];
			$amphur_id = empty($ids[1]) ? null : $ids[1];
			if ($province_id != null)
			{
				$data = $this->getDistrict($amphur_id);
				echo Json::encode(['output'=>$data, 'selected'=>'']);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}
	
	protected function getAmphur($id)
	{
		$datas = Amphur::find()->where(['province_id'=>$id])->all();
		return $this->MapData($datas,'id','name');
	}
	
	protected function getDistrict($id)
	{
		$datas = District::find()->where(['amphur_id'=>$id])->all();
		return $this->MapData($datas,'id','name');
	}
	
	protected function MapData($datas,$fieldId,$fieldName)
	{
		$obj = [];
		foreach ($datas as $key => $value)
		{
			array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
		}
		return $obj;
	}
}
