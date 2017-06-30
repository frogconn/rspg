<?php

namespace app\controllers;

use Yii;

use app\models\Zone;
use app\models\ResearchZone;
use app\models\ResearchZoneSearch;
use app\models\Province;
use app\models\Amphur;
use app\models\District;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

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
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $researchZone = $this->findResearchZone($id);

        return $this->render('view', [
            'model' => $researchZone
        ]);
    }

    /**
     * Creates a new ResearchZone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $zone = new Zone();
        $researchZone = new ResearchZone();
        $province = new Province();
        $amphur = new Amphur();
        $district = new District();

        $amphur_list = [];
        $district_list = [];
    
        if (isset($_POST) && $_POST!=null) {
			
            $zone->zone_name = $_POST['Zone']['zone_name'];

            if($zone->load(Yii::$app->request->post()) && $zone->save(false)){
                $researchZone->zone_id = $zone->zone_id;
                $researchZone->p_id = $_POST['Province']['p_name'];
                $researchZone->a_id = $_POST['Amphur']['a_name'];
                $researchZone->d_id = $_POST['District']['d_name'];
                $researchZone->gen_info = $_POST['ResearchZone']['gen_info'];

                $researchZone->save();
                //return $this->redirect(['research-zone/index']);
                return $this->redirect(['view', 'id' => $zone->zone_id]);
            }
        } else {
            return $this->render('create', [
                'zone' => $zone,
                'province' => $province,
                'amphur' => $amphur,
                'district' => $district,
                'researchZone' => $researchZone,
                'amphur_list' => $amphur_list,
                'district_list' => $district_list
            ]);
        }   
    }

    /**
     * Updates an existing ResearchZone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $zone = $this->findZone($id); // Get row that selected id equals pers_id
        $researchZone = $this->findResearchZone($zone->zone_id);
        $province = $this->findProvice($researchZone->p_id);
        $amphur = $this->findAmphur($researchZone->a_id);
        $district = $this->findDistrict($researchZone->d_id);

        $amphur_list = ArrayHelper::map($this->getAmphur($researchZone->p_id),'id','name');
        $district_list = ArrayHelper::map($this->getDistrict($researchZone->a_id), 'id','name');

        if ($zone->load(Yii::$app->request->post())) {
            $zone->zone_name = $_POST['Zone']['zone_name'];

            $isValid = $zone->validate();
           if($isValid){
                $zone->save(false);
                $researchZone->p_id = $_POST['Province']['p_name'];
                $researchZone->a_id = $_POST['Amphur']['a_name'];
                $researchZone->d_id = $_POST['District']['d_name'];
                $researchZone->gen_info = $_POST['ResearchZone']['gen_info'];

                $researchZone->save();
                //return $this->redirect(['research-zone/index']);
                return $this->redirect(['view', 'id' => $zone->zone_id]);
            }
        } else {
            return $this->render('update', [
                'zone' => $zone,
                'province' => $province,
                'amphur' => $amphur,
                'district' => $district,
                'researchZone' => $researchZone,
                'amphur_list' => $amphur_list,
                'district_list' => $district_list
            ]);
        }
    }

    /**
     * Deletes an existing ResearchZone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $zone = $this->findZone($id);
        $researchZone = $this->findResearchZone($zone->zone_id);
    
        $researchZone->delete();
        $zone->delete();

        return $this->redirect(['index']);
    }

    protected function findZone($id){
        if (($model = Zone::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, Zone does not exist.');
        }
    }

    protected function findResearchZone($id){
        if (($model = ResearchZone::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, ResearchZone does not exist.');
        }
    }

    protected function findProvice($id){
        if (($model = Province::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, province does not exist.');
        }
    }

    protected function findAmphur($id){
        if (($model = Amphur::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, amphur does not exist.');
        }
    }

    protected function findDistrict($id){
        if (($model = District::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, district does not exist.');
        }
    }

    // Support selecting province, filter amphur_list
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
        $datas = Amphur::find()->where(['p_id'=>$id])->all();
        return $this->MapData($datas,'id','a_name');
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
        $datas = District::find()->where(['a_id'=>$id])->all();
        return $this->MapData($datas,'id','d_name');
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
