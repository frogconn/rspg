<?php

namespace app\controllers;


use Yii;
use app\models\ResourcePlant;
use app\models\ResourcePlantSearch;
use app\models\ResearchArea;
use app\models\ResourceType;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

/**
 * ResourcePlantController implements the CRUD actions for ResourcePlant model.
 */
class ResourcePlantController extends Controller
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
     * Lists all ResourcePlant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResourcePlantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResourcePlant model.
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
     * Creates a new ResourcePlant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $plant = new ResourcePlant();
        $type  = new ResourceType();
        $researchArea = new  ResearchArea();

        if (isset($_POST) && $_POST!=null) {
           
            

            if($plant->load(Yii::$app->request->post()) && $plant->save(false)){
                $plant ->id = $plant -> id;
                $plant->common_name = $_POST['ResourcePlant']['common_name'];
                $plant->location_name = $_POST['ResourcePlant']['location_name'];
                $plant->science_name = $_POST['ResourcePlant']['science_name'];
                $plant->family_name = $_POST['ResourcePlant']['family_name'];
                $plant->information = $_POST['ResourcePlant']['information'];
                $plant->zone_id = $_POST['ResearchArea']['name'];
                $plant->benefit = $_POST['ResourcePlant']['benefit'];


                $plant->save(false);
                return $this->redirect(['resource-plant/']);
                //return $this->redirect(['view', 'id' => $researchArea->id]);
            }
        } else {
            return $this->render('create', [
                'plant' => $plant,
                'type'  => $type,
                'researchArea' => $researchArea
            ]);
        }
    }

    /**
     * Updates an existing ResourcePlant model.
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
     * Deletes an existing ResourcePlant model.
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
     * Finds the ResourcePlant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResourcePlant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResourcePlant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
