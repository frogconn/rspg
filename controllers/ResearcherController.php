<?php

namespace app\controllers;

use Yii;

use app\models\AttachFiles;
use app\models\Researcher;
use app\models\ResearcherAgency;
use app\models\ResearcherFaculty;
use app\models\ResearcherInstitution;
use app\models\ResearcherSearch;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use \dektrium\user\models\User;

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
        $model = $this->findModel($id);
        $agency = $this->findAgency($model->personal_code);
        $instit = $this->findInstitution($agency->institution_id);
        $faculty = $this->findFaculty($agency->faculty_id);
        $created_by = $this -> findUser($model->created_by);
        $updated_by = $this -> findUser($model->updated_by);
        return $this->render('view', [
			'model' => $this->findModel($id),
			//'attach_file' => $this->findAttach('app\models\Researcher',$id),
            'instit' => $instit,
            'faculty' => $faculty,
            'agency' => $agency,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }


    /**
     * Creates a new Researcher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Researcher();
        $instit = new ResearcherInstitution();// institution
        $faculty = new ResearcherFaculty();
        $agency = new ResearcherAgency();
        $faculty_list = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate())
            {
                $model->evidence_file = $model->upload($model,'evidence_file');
                $model->save();
            }
            if($model->save()){
                $agency->researcher_id=$model->id;
                $agency->personal_code = $_POST['Researcher']['personal_code'];
                $agency->faculty_id = $_POST['ResearcherAgency']['faculty_id'];
                $agency->institution_id = $_POST['ResearcherAgency']['institution_id'];
                $agency->save();
            }
            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'instit' => $instit,
                'faculty' => $faculty,
                'agency' => $agency,
                'faculty_list' => $faculty_list,
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

        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        } 

        $agency = $this->findAgency($model->personal_code);
        $instit = $this->findInstitution($agency->institution_id);
        $faculty = $this->findFaculty($agency->faculty_id);
        $faculty_list = ArrayHelper::map($this->getFaculty($agency->institution_id),'id','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($model->validate())
            {
                $model->evidence_file = $model->upload($model,'evidence_file');
                $model->save();
            }
                if($model->save()){
                    $agency->researcher_id=$model->id;
                    $agency->personal_code = $_POST['Researcher']['personal_code'];
                    $agency->faculty_id = $_POST['ResearcherAgency']['faculty_id'];                        
                    $agency->institution_id = $_POST['ResearcherAgency']['institution_id'];
                    $agency->save();
                }
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'instit' => $instit,
                    'faculty' => $faculty,
                    'agency'=>$agency,
                    'faculty_list' => $faculty_list,
                
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
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }
        $this->findModel($id)->delete();
        $this->findAgency($model->personal_code)->delete();
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
            throw new NotFoundHttpException('[researcher]The requested page does not exist.');
        }
    }

    protected function findUser($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[researcher]The requested page does not exist.');
        }
    }
    // new code
    public function actionGetFaculty() {
     $out = [];
     if (isset($_POST['depdrop_parents'])) {
         $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
             $institution_id = $parents[0];
             $out = $this->getFaculty($institution_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
     }
     echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    protected function getFaculty($id){
     $datas = ResearcherFaculty::find()->where(['institution_id'=>$id])->all();
     return $this->MapData($datas,'id','name');
    }
    protected function MapData($datas,$fieldId,$fieldName){
     $obj = [];
     foreach ($datas as $key => $value) {
         array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
     }
     return $obj;
    }
    // new findmodel
    protected function findAgency($id)
    {
        if (($agency = ResearcherAgency::findOne(['personal_code'=>$id])) !== null) {
            return $agency;
        } else {
            throw new NotFoundHttpException('[agency]The requested page does not exist.');
        }
    }
    protected function findInstitution($id)
    {
        if (($instit = ResearcherInstitution::findOne($id)) !== null) {
            return $instit;
        } else {
            throw new NotFoundHttpException('[institution]The requested page does not exist.');
        }
    }
    protected function findFaculty($id)
    {
        if (($faculty = ResearcherFaculty::findOne($id)) !== null) {
            return $faculty;
        } else {
            throw new NotFoundHttpException('[faculty]The requested page does not exist.');
        }
    }
	// get images
	protected function findAttach($name,$id)
    {
        if (($attach = AttachFiles::findOne(['itemId'=>$id,'model'=>$name])) !== null) {
            return $attach;
        } else {
            throw new NotFoundHttpException('[attachFile]The requested page does not exist.'.$name.$id);
        }
    }
	//
}
