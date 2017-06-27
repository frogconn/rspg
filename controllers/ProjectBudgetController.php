<?php

namespace app\controllers;

use Yii;
use app\models\Project;
use app\models\ProjectBudget;
use app\models\ProjectBudgetSearch;
use app\models\Researcher;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

/**
 * ProjectBudgetController implements the CRUD actions for ProjectBudget model.
 */
class ProjectBudgetController extends Controller
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
     * Lists all ProjectBudget models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectBudgetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectBudget model.
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
     * Creates a new ProjectBudget model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $researcher = new Researcher();
        $proj = new Project();
        $projB = new ProjectBudget();

        if (isset($_POST) && $_POST!=null) {

            if($proj->save(false)){

            }
            return $this->redirect(['project-budget/index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'proj' => $proj,
                'projB' => $projB,
                'researcher' => $researcher
            ]);
        }

        /*if (isset($_POST) && $_POST!=null) {
			$researcher->gender = $_POST['Researcher']['gender'];
            $researcher->foreigner = $_POST['Researcher']['foreigner'];
            $researcher->pers_id = $_POST['Researcher']['pers_id'];
            $researcher->firstname_th = $_POST['Researcher']['firstname_th'];
            $researcher->lastname_th = $_POST['Researcher']['lastname_th'];
            $researcher->firstname_en = $_POST['Researcher']['firstname_en'];
            $researcher->lastname_en = $_POST['Researcher']['lastname_en'];
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
                //return $this->redirect(['view', 'id' => $researcher->pers_id]);
            }
        } else {
            return $this->render('create', [
                'researcher' => $researcher,
                'instit' => $instit, 
                'faculty' => $faculty,
                'faculty_list' => $faculty_list
            ]);
        }*/
    }

    /**
     * Updates an existing ProjectBudget model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing ProjectBudget model.
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
     * Finds the ProjectBudget model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProjectBudget the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProjectBudget::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
