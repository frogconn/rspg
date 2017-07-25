<?php

namespace app\controllers;

use Yii;

use app\base\Model;

use app\models\ProjectEcology;
use app\models\ProjectEcologySearch;
use app\models\ProjectPartitions;
use app\models\ProjectType;
use app\models\Researcher;
use app\models\ResearcherAgency;
use app\models\ResearcherFaculty;
use app\models\ResearcherInstitution;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\JsonParser;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\widgets\ActiveForm;

use \dektrium\user\models\User;

/**
 * ProjectEcologyController implements the CRUD actions for ProjectEcology model.
 */
class ProjectEcologyController extends Controller
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
     * Lists all ProjectEcology models.
     * @return mixed
     */

     //new code 7/19/17
    
    public function actionIndexAdmin() // url : resource-plant/index-admin
    {
        $searchModel = new ProjectEcologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index-admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResourcePlant model.
     * @param string $id
     * @return mixed
     */
    public function actionViewAdmin($id)
    {
        $model = $this->findModel($id);
        $created_by = $this->findUser($model->created_by);
        $updated_by = $this->findUser($model->updated_by);
        $researcher =$this->findResearcher($model->created_by); //not complete edit $xxx
        
        return $this->render('view-admin', [
            'model' => $this->findModel($id),
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'reesearcher' => $researcher,
        ]);
    }
     //new code 7/19/17
    
    public function actionIndex()
    {
        $searchModel = new ProjectEcologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single ProjectEcology model.
     * @param integer $id
     * @return mixed
     */
    
    public function actionView($id)
    {
        $project = $this->findProject($id);
        $researcher = Researcher::findOne(['personal_code'=>$project->personal_code]);
        $created_by = $this -> findUser($project->created_by);
        $updated_by = $this -> findUser($project->updated_by);
        return $this->render('view', [
            'model' => $this->findProject($id),
            'researcher' => $researcher,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }

    /**
     * Creates a new ProjectEcology model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $project = new ProjectEcology();
        $type = new ProjectType();
        $faculty = new ResearcherFaculty();
        $type_list = [];
        $faculty_list = [];

        if($project->load(Yii::$app->request->post()))
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $post = Yii::$app->request->post();
                $project->type_id = $post['ProjectType']['type'];
                $project->start = $post['ProjectEcology']['start'];
                $project->stop = $post['ProjectEcology']['stop'];
                $project->save(false);

                $agency = ResearcherAgency::find()->where(['personal_code'=>$project->personal_code])->one();
                $project->faculty_id = $agency->faculty_id;
                $project->save(false);

                $items = Yii::$app->request->post();

                // Loop to save each partition detail
                foreach($items['ProjectEcology']['schedule'] as $key => $val){
                    /*if(($partitions = ProjectPartitions::findOne(['telephone'=>$val['telephone']])) == null) {}*/
                    $partitions = new ProjectPartitions();
                    $partitions->project_id = $project->id;
                    $partitions->fullname = $val['fullname'];
                    $partitions->position = $val['position'];
                    $partitions->telephone = $val['telephone'];
                    $partitions->email = $val['email'];
                    $partitions->group = 'ecology'; 

                    $partitions->save();
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view-admin', 'id' => $project->id]);
            } catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'มีข้อผิดพลาดในการบันทึก');
                return $this->redirect(['view-admin', 'id' => $project->id]);
            }
        } else {
            return $this->render('create', [
                'project' => $project,
                'type' => $type,
                'faculty' => $faculty,
                'type_list' => $type_list,
                'faculty_list' => $faculty_list
            ]); 
        }   
         
    }

    /**
     * Updates an existing ProjectEcology model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $project = ProjectEcology::findOne($id);

        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $project]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }     

        $type = ProjectType::findOne($project->type_id);
        $type_list = ArrayHelper::map($this->getType($type->sub_topic), 'id', 'name'); 
       
        $agency = ResearcherAgency::findOne(['personal_code'=>$project->personal_code]);
        $faculty = ResearcherFaculty::findOne($agency->faculty_id);
        $faculty_list = ArrayHelper::map($this->getFaculty($agency->institution_id), 'id', 'name');

        $project->schedule = ProjectPartitions::find()->andWhere(['project_id'=>$project->id])
                                                      ->andWhere(['group'=>'ecology'])->all();
        if (isset($_POST) && $_POST!=null) 
        {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $post = Yii::$app->request->post();
                $project->personal_code = $post['ProjectEcology']['personal_code'];
                $project->type_id = $post['ProjectType']['type'];
                $project->start = $post['ProjectEcology']['start'];
                $project->stop = $post['ProjectEcology']['stop'];
                $project->year = $post['ProjectEcology']['year'];
                $project->name = $post['ProjectEcology']['name'];
                $project->budget = $post['ProjectEcology']['budget'];
                $project->summary = $post['ProjectEcology']['summary'];
                $project->save(false);

                $partition = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
                $project->save(false);

                $partition = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
                foreach ($partition as $model) {
                    $model->delete(); // Delete each row partition
                }

                $items = Yii::$app->request->post();
                foreach($items['ProjectEcology']['schedule'] as $key => $val){
                    $partitions = new ProjectPartitions();
                    $partitions->project_id = $project->id;
                    $partitions->fullname = $val['fullname'];
                    $partitions->position = $val['position'];
                    $partitions->telephone = $val['telephone'];
                    $partitions->email = $val['email'];
                    $partitions->group = 'ecology';
                    $partitions->save();
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view-admin', 'id' => $project->id]);
            } catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'มีข้อผิดพลาดในการบันทึก');
                return $this->redirect(['view-admin', 'id' => $project->id]);
            }

        } else {
            return $this->render('update', [
                'project' => $project,
                'type' => $type,
                'faculty' => $faculty,
                'type_list' => $type_list,
                'faculty_list' => $faculty_list
            ]);
        }
    }

    /**
     * Deletes an existing ProjectEcology model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        $project = $this->findProject($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $project]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }  
        
        $partitions = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
        foreach ($partitions as $model) {
            $model->delete(); // Delete each row partition
        }
        $project->delete();

        return $this->redirect(['index-admin']);
    }

    /**
     * Finds the ProjectEcology model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectEcology the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProject($id)
    {
        if (($model = ProjectEcology::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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

    public function actionGetFaculty() {
     $out = [];
     if (isset($_POST['depdrop_parents'])) {
         $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
             $personal_code = $parents[0];
             $agency = ResearcherAgency::findOne(['personal_code'=>$personal_code]);
             $out = $this->getFaculty($agency->institution_id);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
     }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getFaculty($id){
        $datas = ResearcherFaculty::find()->where(['institution_id'=>$id])->all();
        return $this->MapData($datas, 'id', 'name');
    }

    public function actionGetType() {
     $out = [];
     if (isset($_POST['depdrop_parents'])) {
         $parents = $_POST['depdrop_parents'];
         if ($parents != null) {
             $sub_topic = $parents[0];
             $out = $this->getType($sub_topic);
             echo Json::encode(['output'=>$out, 'selected'=>'']);
             return;
         }
     }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getType($sub_topic){
        $datas = ProjectType::find()->where(['sub_topic'=>$sub_topic])->all();
        return $this->MapData($datas, 'id', 'type');
    }

    protected function MapData($datas, $fieldId, $fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId}, 'name'=>$value->{$fieldName}]);
        }
        return $obj; // key of mapdata is id and name
    }

    // new code 19 Jul 2017
    protected function findModel($id)
    {
        if (($model = ProjectEcology::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[ProjectEcology]The requested page, plant does not exist.');
        }
    }

        protected function findResearcher($id)
    {
        if (($model = ProjectEcology::findOne(['id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[researcher]The requested page, plant does not exist.'.$id);
        }
    }
}
