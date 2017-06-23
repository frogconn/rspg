<?php

namespace app\controllers;

use Yii;
use app\models\Researcher;
use app\models\Agency;
use app\models\Institution;
use app\models\Faculty;
use app\models\ResearcherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * ResearcherController implements the CRUD actions for Researcher model.
 */
class ResearcherController extends Controller
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
     * Lists all Researcher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResearcherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Researcher model.
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
     * Creates a new Researcher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $researcher = new Researcher();
        $agency = new Agency();
        $instit = new Institution();
        $faculty = new Faculty();  

        if (isset($_POST) && $_POST!=null) {
			$researcher->gender = $_POST['Researcher']['gender'];
            $researcher->foreigner = $_POST['Researcher']['foreigner'];
            $researcher->pers_id = $_POST['Researcher']['pers_id'];
            $researcher->firstname_th = $_POST['Researcher']['firstname_th'];
            $researcher->lastname_th = $_POST['Researcher']['lastname_th'];
            $researcher->firstname_en = $_POST['Researcher']['firstname_th'];
            $researcher->lastname_en = $_POST['Researcher']['lastname_th'];
            $researcher->fullname_th = $researcher->getFullnameTh();
            $researcher->fullname_en = $researcher->getFullnameEn();
            $researcher->email = $_POST['Researcher']['email'];
            $researcher->telephone = $_POST['Researcher']['telephone'];

            if($researcher->save()){
                $agency->pers_id = $researcher->pers_id;
                $agency->fac_code = $_POST['Faculty']['fac_name'];
                $agency->inst_code = $_POST['Institution']['inst_name'];

                $agency->save();
                return $this->redirect(['researcher/index']);
            }
        } else {
            return $this->render('create', [
                'researcher' => $researcher,
                'instit' => $instit, 
                'faculty' => $faculty,
            ]);
        }

        
    }

    /**
     * Updates an existing Researcher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->evidence_file = $model->upload($model,'evidence_file');
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Researcher model.
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
     * Finds the Researcher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Researcher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Researcher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetFaculty() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $inst_code = $parents[0];
                $out = $this->getFaculty($inst_code);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getFaculty($id){
        $datas = Faculty::find()->where(['inst_code'=>$id])->all();
        return $this->mapData($datas,'fac_code','fac_name');
    }

    protected function mapData($datas, $code, $name){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$code}, 'name'=>$value->{$name}]);
        }
        return $obj;
    }
}
