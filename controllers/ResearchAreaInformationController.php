<?php

namespace app\controllers;

use Yii;

use app\models\AddressAmphur;
use app\models\AddressDistrict;
use app\models\AddressProvince;
use app\models\AddressRegion;
use app\models\ResearchArea;
use app\models\ResearchAreaInformation;
use app\models\ResearchAreaInformationSearch;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use \dektrium\user\models\User;

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
     * Lists all ResearchAreaInformation models.
     * @return mixed
     */


    public function actionViewAdmin($id)
    {
        $model = $this->findModel($id);
        $area_name = $this->findArea($model->area_id);
        $created_by = $this -> findUser($model->created_by);
        $updated_by = $this -> findUser($model->updated_by);
        return $this->render('view', [
            'model' => $model,
            'area_name' => $area_name,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }

     public function actionIndexAdmin()
    {
        $searchModel = new ResearchAreaInformationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

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
		$model = $this->findModel($id);
		$area_name = $this->findArea($model->area_id);
        $created_by = $this -> findUser($model->created_by);
        $updated_by = $this -> findUser($model->updated_by);
        return $this->render('view', [
            'model' => $model,
			'area_name' => $area_name,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
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
        $province = new AddressProvince();
        $amphur   = new AddressAmphur();
        $district = new AddressDistrict();
        $information = new ResearchAreaInformation();
		$amphur_list=[];
		$district_list=[];

         if (isset($_POST) && $_POST!=null) {
           
            $researchArea->name = $_POST['ResearchArea']['name'];

            if($researchArea->load(Yii::$app->request->post()) && $researchArea->save(false)){
                $information ->area_id = $researchArea -> id;
                $information->province_id = $_POST['AddressProvince']['name'];
                $information->amphur_id = $_POST['AddressAmphur']['name'];
                $information->district_id = $_POST['AddressDistrict']['name'];
                $information->information = $_POST['ResearchAreaInformation']['information'];
                $information->save(false);

                $information->region_id = $this->findProvince($information->province_id)->region_id;
                $information->save(false);

                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $information->id]);
            }
        } else {
            return $this->render('create', [
            'researchArea'  => $researchArea,
            'province'      => $province, 
            'amphur'        => $amphur,
            'district'      => $district,
            'information'   => $information,
			'amphur_list'   => $amphur_list,
			'district_list' => $district_list,
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
        $information = $this->findModel($id);

        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $information]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        } 

		$researchArea = $this->findArea($information->area_id);
		$province = $this->findProvince($information->province_id);
        $amphur   = $this->findAmphur($information->amphur_id);
        $district = $this->findDistrict($information->district_id);
		$amphur_list = ArrayHelper::map($this->getAmphur($information->province_id),'id','name');
		$district_list = ArrayHelper::map($this->getDistrict($information->amphur_id),'id','name');

        if (isset($_POST) && $_POST!=null) {
           
            $researchArea->name = $_POST['ResearchArea']['name'];

            if($researchArea->load(Yii::$app->request->post()) && $researchArea->save(false)){
                $information ->area_id = $researchArea -> id;
                $information->province_id = $_POST['AddressProvince']['name'];
                $information->amphur_id = $_POST['AddressAmphur']['name'];
                $information->district_id = $_POST['AddressDistrict']['name'];
                $information->information = $_POST['ResearchAreaInformation']['information'];
                $information->save(false);

                $information->region_id = $this->findProvince($information->province_id)->region_id;
                $information->save(false);

                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $information->id]);
            }
        } else {
            return $this->render('update', [
                'information' => $information,
				'researchArea' => $researchArea,
				'province' => $province,
				'amphur' => $amphur,
				'district' => $district,
				'amphur_list' => $amphur_list,
				'district_list' => $district_list,
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
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }
        ResearchArea::findOne($model->area_id)->delete();
        $model->delete();
        return $this->redirect(['index-admin']);
    }

    /**
     * Finds the ResearchAreaInformation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResearchAreaInformation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
	 
	 // find method
    protected function findModel($id)
    {
        if (($model = ResearchAreaInformation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[researcher area information]The requested page does not exist.');
        }
    }
	
	protected function findArea($id)
    {
        if (($model = ResearchArea::findOne(['id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[researcher area]The requested page does not exist.');
        }
    }

    protected function findRegion($id){
        if (($model = AddressRegion::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, district does not exist.');
        }
    }

	
	protected function findProvince($id)
    {
        if (($model = AddressProvince::findOne(['id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[province]The requested page does not exist.');
        }
    }
	
	protected function findAmphur($id)
    {
        if (($model = AddressAmphur::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[amphur]The requested page does not exist.');
        }
    }
	
	protected function findDistrict($id)
    {
        if (($model = AddressDistrict::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[district]The requested page does not exist.');
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
	
	//find method 
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
