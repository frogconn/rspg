<?php

namespace app\controllers;

use Yii;

use app\models\ResearchArea;
use app\models\ResourcePlant;
use app\models\ResourcePlantSearch;
use app\models\ResourceType;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use \dektrium\user\models\User;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'update', 'create', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update', 'create', 'delete'],
                        'roles' => ['@'],
                    ],
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
        $model = $this->findModel($id);
        $created_by = $this->findUser($model->created_by);
        $updated_by = $this->findUser($model->updated_by);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'created_by' => $created_by,
            'updated_by' => $updated_by,
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
                $plant -> id;
                $plant->common_name = $_POST['ResourcePlant']['common_name'];
                $plant->location_name = $_POST['ResourcePlant']['location_name'];
                $plant->science_name = $_POST['ResourcePlant']['science_name'];
                $plant->family_name = $_POST['ResourcePlant']['family_name'];
                $plant->information = $_POST['ResourcePlant']['information'];
                $plant->zone_id = $_POST['ResearchArea']['name'];
                $plant->type_id = $_POST['ResourceType']['name'];
                $plant->benefit = $_POST['ResourcePlant']['benefit'];
                $plant->save(false);

                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $researchArea->id]);
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
        $plant = $this->findModel($id);
        $researchArea = $this->findArea($plant->zone_id ); 
        $type = $this->findType($plant->type_id);

        if ($plant->load(Yii::$app->request->post()) && $plant->save(false)) {
            $plant->common_name = $_POST['ResourcePlant']['common_name'];
            $plant->location_name = $_POST['ResourcePlant']['location_name'];
            $plant->science_name = $_POST['ResourcePlant']['science_name'];
            $plant->family_name = $_POST['ResourcePlant']['family_name'];
            $plant->information = $_POST['ResourcePlant']['information'];
            $plant->zone_id = $_POST['ResearchArea']['name'];
            $plant->type_id = $_POST['ResourceType']['name'];
            $plant->benefit = $_POST['ResourcePlant']['benefit'];
            $plant->save();

            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $plant->id]);
        } else {
            return $this->render('update', [
                'plant' => $plant,
                'type'  => $type,
                'researchArea' => $researchArea
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
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }  
        $model->delete();

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
            throw new NotFoundHttpException('The requested page, plant does not exist.');
        }
    }
 protected function findArea($id)
    {
        if (($model = ResearchArea::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, area does not exist.');
        }
    }

    protected function findType($id)
    {
        if (($model = ResourceType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, type does not exist.');
        }
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[user]The requested page does not exist.');
        }
    }
}

