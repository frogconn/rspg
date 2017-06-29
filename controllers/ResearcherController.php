<?php

namespace app\controllers;

use Yii;
use app\models\Researcher;
use app\models\ResearcherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\ResearcherAgency;
use app\models\ResearcherInstitution;
use app\models\ResearcherFaculty;

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
        $searchresearcher = new ResearcherSearch();
        $dataProvider = $searchresearcher->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchresearcher' => $searchresearcher,
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
            'model' => $this->findresearcher($id),
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
        $agency = new ResearcherAgency();
        $institution = new ResearcherInstitution();
        $faculty = new ResearcherFaculty();  
        $faculty_list = [];

        if (isset($_POST) && $_POST!=null) {
			$researcher->gender = $_POST['Researcher']['gender'];
            $researcher->is_foreigner = $_POST['Researcher']['is_foreigner'];
            $researcher->personal_code = $_POST['Researcher']['personal_code'];
            $researcher->firstname_th = $_POST['Researcher']['firstname_th'];
            $researcher->lastname_th = $_POST['Researcher']['lastname_th'];
            $researcher->firstname_en = $_POST['Researcher']['firstname_en'];
            $researcher->lastname_en = $_POST['Researcher']['lastname_en'];
            $researcher->fullname_th = $researcher->getFullnameTh();
            $researcher->fullname_en = $researcher->getFullnameEn();
            $researcher->email = $_POST['Researcher']['email'];
            $researcher->telephone = $_POST['Researcher']['telephone'];
			
			if($researcher->validate())// check that file is validate
			{
				$researcher->evidence_file = $researcher->upload($researcher,'evidence_file');
				$researcher->save();
			}

            if($researcher->save()){
                $agency->personal_code = $researcher->personal_code;
                $agency->faculty_id = $_POST['Faculty']['name'];
                $agency->institution_id = $_POST['Institution']['name'];

                $agency->save();
                return $this->redirect(['researcher/index']);
                //return $this->redirect(['view', 'id' => $researcher->pers_id]);
            }
        } else {
            return $this->render('create', [
                'researcher' => $researcher,
                'institution' => $institution, 
                'faculty' => $faculty,
                'faculty_list' => $faculty_list
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
        $researcher = $this->findResearcher($id); // Get row that selected id equals pers_id
        $agency = $this->findAgency($researcher->pers_id);
        $instit = $this->findInstitution($agency->inst_code);
        $faculty = $this->findFaculty($agency->fac_code);
        $faculty_list=ArrayHelper::map($this->getFaculty($agency->inst_code), 'id','name');

        if ($researcher->load(Yii::$app->request->post())) {
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
			
			if($researcher->validate())// check that file is validate
			{
				$researcher->evidence_file = $researcher->upload($researcher,'evidence_file');
				$researcher->save();
			}

            $isValid = $researcher->validate();
           if($isValid){
                $researcher->save(false);
                $agency->pers_id = $researcher->pers_id;
                $agency->fac_code = $_POST['ResearcherFaculty']['fac_name'];
                $agency->inst_code = $_POST['ResearcherInstitution']['inst_name'];

                $agency->save();
                return $this->redirect(['view', 'id' => $researcher->pers_id]);
                //return $this->redirect(['researcher/index']);
            }
        } else {
            return $this->render('update', [
                'researcher'=>$researcher,
                'instit'=>$instit,
                'faculty'=>$faculty,
                'faculty_list'=>$faculty_list
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
        $this->findresearcher($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Researcher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Researcher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findresearcher($id)
    {
        if (($researcher = Researcher::findOne($id)) !== null) {
            return $researcher;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
