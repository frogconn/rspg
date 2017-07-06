<?php

namespace app\controllers;

use Yii;
use app\models\ProjectEcology;
use app\models\ProjectEcologySearch;
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
        ];
    }

    /**
     * Lists all ProjectEcology models.
     * @return mixed
     */
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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

        if($project->load(Yii::$app->request->post()))
        {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $post = Yii::$app->request->post();
                $project->type_id = $post['ProjectType']['type'];
                $project->start = $post['ProjectEcology']['start'];
                $project->stop = $post['ProjectEcology']['stop'];

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
     * Updates an existing ProjectEcology model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $project = ProjectEcology::findOne($id);
        $type = ProjectType::findOne($project->type_id);
        $project->schedule = ProjectPartitions::find()->andWhere(['project_id'=>$project->id])
                                                      ->andWhere(['group'=>'ecology'])->all();
        if (isset($_POST) && $_POST!=null) 
        {
            $transaction = Yii::$app->db->beginTransaction();
            try{

                $post = Yii::$app->request->post();
                $project->type_id = $post['ProjectType']['type'];
                $project->start = $post['ProjectEcology']['start'];
                $project->stop = $post['ProjectEcology']['stop'];
                $project->year = $post['ProjectEcology']['year'];
                $project->name = $post['ProjectEcology']['name'];
                $project->personal_code = $post['ProjectEcology']['personal_code'];
                $project->budget = $post['ProjectEcology']['budget'];
                $project->summary = $post['ProjectEcology']['summary'];


                $project->save();

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
       $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectEcology model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectEcology the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectEcology::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
