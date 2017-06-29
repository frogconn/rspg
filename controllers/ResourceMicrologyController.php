<?php

namespace app\controllers;

use Yii;
use app\models\ResourceMicrology;
use app\models\ResourceMicrologySearch;
use app\models\ResourceType;
use app\models\ResearchArea;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

/**
 * ResourceMicrologyController implements the CRUD actions for ResourceMicrology model.
 */
class ResourceMicrologyController extends Controller
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
     * Lists all ResourceMicrology models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResourceMicrologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResourceMicrology model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findMicro($id),
        ]);
    }

    /**
     * Creates a new ResourceMicrology model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $micro = new ResourceMicrology();
        $area = new ResearchArea();
        $type = new ResourceType();

        if ($micro->load(Yii::$app->request->post()) && $micro->save(false)) {
            //print_r($_POST);
            $micro->zone_id = $_POST['ResearchArea']['name'];
            $micro->type_id = $_POST['ResourceType']['name'];
            $micro->genus   = $_POST['ResourceMicrology']['genus'];
            $micro->species = $_POST['ResourceMicrology']['species'];
            $micro->benefit = $_POST['ResourceMicrology']['benefit'];

            $micro->save();
            return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('create', [
                'micro' => $micro,
                'area' => $area,
                'type' => $type,
            ]);
        }
    }

    /**
     * Updates an existing ResourceMicrology model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $micro = $this->findMicro($id);
        $area = $this->findArea($micro->zone_id ); 
        $type = $this->findType($micro->type_id);


        if ($micro->load(Yii::$app->request->post()) && $micro->save(false)) {
            $micro->zone_id = $_POST['ResearchArea']['name'];
            $micro->type_id = $_POST['ResourceType']['name'];
            $micro->genus   = $_POST['ResourceMicrology']['genus'];
            $micro->species = $_POST['ResourceMicrology']['species'];
            $micro->benefit = $_POST['ResourceMicrology']['benefit'];

            $micro->save();
            return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('update', [
                'micro' => $micro,
                'area'  => $area,
                'type'  => $type,
            ]);
        }
    }

    /**
     * Deletes an existing ResourceMicrology model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findMicro($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ResourceMicrology model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResourceMicrology the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMicro($id)
    {
        if (($model = ResourceMicrology::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, micrology does not exist.');
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
}