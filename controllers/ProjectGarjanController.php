<?php

namespace app\controllers;

use Yii;
use app\models\ProjectGarjan;
use app\models\ProjectGarjanSearch;
use app\models\ProjectType;
use app\models\ProjectPartitions;
use app\models\Researcher;
use app\models\ResearcherAgency;
use app\models\ResearcherInstitution;
use app\models\ResearcherFaculty;

use yii\widgets\ActiveForm;

use yii\web\Controller;
use yii\web\JsonParser;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

use app\base\Model;

/**
 * ProjectGarjanController implements the CRUD actions for ProjectGarjan model.
 */
class ProjectGarjanController extends Controller
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
     * Lists all ProjectGarjan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectGarjanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectGarjan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findProject($id),
        ]);
    }

    /**
     * Creates a new ProjectGarjan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $project = new ProjectGarjan();
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
                $project->save(false);

                $agency = ResearcherAgency::find()->where(['personal_code'=>$project->personal_code])->one();
                $project->faculty_id = $agency->faculty_id;
                $project->save(false);

                $items = Yii::$app->request->post();

                // Loop to save each partition detail
                foreach($items['ProjectGarjan']['schedule'] as $key => $val){
                    /*if(($partitions = ProjectPartitions::findOne(['telephone'=>$val['telephone']])) == null) {}*/
                    $partitions = new ProjectPartitions();
                    $partitions->project_id = $project->id;
                    $partitions->fullname = $val['fullname'];
                    $partitions->position = $val['position'];
                    $partitions->telephone = $val['telephone'];
                    $partitions->email = $val['email'];
                    $partitions->group = 'garjan'; 

                    $partitions->save();
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $project->id]);
            } catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'มีข้อผิดพลาดในการบันทึก');
                return $this->redirect(['view', 'id' => $project->id]);
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
     * Updates an existing ProjectGarjan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $project = ProjectGarjan::findOne($id);
        $type = ProjectType::findOne($project->type_id);
        $type_list = ArrayHelper::map($this->getType($type->sub_topic), 'id', 'name'); 
       
        $agency = ResearcherAgency::findOne(['personal_code'=>$project->personal_code]);
        $faculty = ResearcherFaculty::findOne($agency->faculty_id);
        $faculty_list = ArrayHelper::map($this->getFaculty($agency->institution_id), 'id', 'name');
        
        $project->schedule = ProjectPartitions::find()->andWhere(['project_id'=>$project->id])
                                                      ->andWhere(['group'=>'garjan'])->all();

        if (isset($_POST) && $_POST!=null) 
        {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $post = Yii::$app->request->post();
                $project->personal_code = $post['ProjectGarjan']['personal_code'];
                $project->type_id = $post['ProjectType']['type'];
                $project->save();

                $project->faculty_id = $post['ResearcherFaculty']['name'];
                $project->save();

                $partition = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
                foreach ($partition as $model) {
                    $model->delete(); // Delete each row partition
                }

                $items = Yii::$app->request->post();
                foreach($items['ProjectGarjan']['schedule'] as $key => $val){
                    $partitions = new ProjectPartitions();
                    $partitions->project_id = $project->id;
                    $partitions->fullname = $val['fullname'];
                    $partitions->position = $val['position'];
                    $partitions->telephone = $val['telephone'];
                    $partitions->email = $val['email'];
                    $partitions->save();
                }
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
                return $this->redirect(['view', 'id' => $project->id]);
            } catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'มีข้อผิดพลาดในการบันทึก');
                return $this->redirect(['view', 'id' => $project->id]);
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
     * Deletes an existing ProjectGarjan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $project = $this->findProject($id);
        $partitions = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
        foreach ($partitions as $model) {
            $model->delete(); // Delete each row partition
        }
        $project->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectGarjan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectGarjan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProject($id)
    {
        if (($model = ProjectGarjan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*public function actionGetFaculty($personal_code){
        // Find the personal code from the researcher table
        $agency = ResearcherAgency::find()->where(['personal_code'=>$personal_code])->one();
        $faculty = ResearcherFaculty::find()->where(['id'=>$agency->faculty_id])->one();
        echo Json::encode($faculty);
    }*/

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
}