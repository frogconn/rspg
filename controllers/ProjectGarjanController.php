<?php

namespace app\controllers;

use Yii;
use app\models\ProjectGarjan;
use app\models\ProjectGarjanSearch;
use app\models\ProjectType;
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
            'model' => $this->findModel($id),
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
    
        if($project->load(Yii::$app->request->post()))
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $project->save(false);
                $items = Yii::$app->request->post();

                // Loop to save each partition detail
                foreach($items['ProjectGarjan']['schedule'] as $key => $val){
                    /*if(($partitions = ProjectPartitions::findOne(['telephone'=>$val['telephone']])) == null) {
                        
                    }*/
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
                'type' => $type
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
        $type = ProjectType::findOne($project->project_type_id);
        $project->schedule = ProjectPartitions::find()->andWhere(['project_id'=>$project->id])
                                                      ->andWhere(['group'=>'garjan'])->all();
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
                'type' => $type
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectGarjan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectGarjan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectGarjan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
