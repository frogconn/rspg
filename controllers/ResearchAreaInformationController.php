<?php

namespace app\controllers;

use Yii;
use app\models\ResearchAreaInformation;
use app\models\ResearchAreaInformationSearch;
use app\models\ResearchArea;
use app\models\AddressProvince;
use app\models\AddressAmphur;
use app\models\AddressDistrict;
use app\models\AddressRegion;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;






/**
 * ResearchAreaInformationController implements the CRUD actions for ResearchAreaInformation model.
 */
class ResearchAreaInformationController extends Controller
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
     * Lists all ResearchAreaInformation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResearchAreaInformationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResearchAreaInformation model.
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
     * Creates a new ResearchAreaInformation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $researchArea   = new ResearchArea();
        $provinceid = new AddressProvince();
        $amphurid   = new AddressAmphur();
        $districtid = new AddressDistrict();
        //$regionid   = new AddressRegion();
        $information = new ResearchAreaInformation();

         if (isset($_POST) && $_POST!=null) {
           
            $researchArea->name = $_POST['ResearchArea']['name'];

            if($researchArea->load(Yii::$app->request->post()) && $researchArea->save(false)){
                $information ->area_id = $researchArea -> id;
                $information->province_id = $_POST['AddressProvince']['name'];
                $information->amphur_id = $_POST['AddressAmphur']['name'];
                $information->district_id = $_POST['AddressDistrict']['name'];
                //$information->region_id = $_POST['AddressDistrict']['name'];//
                $information->information = $_POST['ResearchAreaInformation']['information'];

                $information->save(false);
                return $this->redirect(['research-area-information/index']);
                //return $this->redirect(['view', 'id' => $researchArea->id]);
            }
        } else {
            return $this->render('create', [
            'researchArea'  => $researchArea,
            'provinceid'    => $provinceid, 
            'amphurid'      => $amphurid,
            'districtid'    => $districtid,
            //'regionid'      => $regionid,
            'information'   => $information,
           ]);
     
        }

        
    }

    /**
     * Updates an existing ResearchAreaInformation model.
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
     * Deletes an existing ResearchAreaInformation model.
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
     * Finds the ResearchAreaInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResearchAreaInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResearchAreaInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionGetAmphur() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getAmphur($id)
    {
        $datas = AddressAmphur::find()->where(['province_id'=>$id])->all();
        return $this->MapData($datas,'id','name');
    }

    // Support selecting province, filter district to district_list
    public function actionGetDistrict() 
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
                $data = $this->getDistrict($amphur_id);
                echo Json::encode(['output'=>$data, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getDistrict($id)
    {
        $datas = AddressDistrict::find()->where(['amphur_id'=>$id])->all();
        return $this->MapData($datas,'id','name');
    }

    protected function MapData($datas,$fieldId,$fieldName)
    {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }
}
