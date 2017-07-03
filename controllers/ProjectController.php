<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectSearch;
use app\models\ProjectPartitions;
use app\models\Researcher;

use yii\widgets\ActiveForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;

use app\base\Model;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findProject($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $project = new Project();
    
        if($project->load(Yii::$app->request->post()))
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $project->save(false);
                $items = Yii::$app->request->post();

                // Loop to save each partition detail
                foreach($items['Project']['schedule'] as $key => $val){
                    /*if(($partitions = ProjectPartitions::findOne(['telephone'=>$val['telephone']])) == null) {
                        
                    }*/
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
            return $this->render('create', [
                'project' => $project,
            ]);
        }     
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $project = Project::findOne($id);
        $project->schedule = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
        if (isset($_POST) && $_POST!=null) 
        {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $project->save();

                $partition = ProjectPartitions::find()->where(['project_id'=>$project->id])->all();
                foreach ($partition as $model) {
                    $model->delete(); // Delete each row partition
                }

                $items = Yii::$app->request->post();
                foreach($items['Project']['schedule'] as $key => $val){
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
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProject($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
