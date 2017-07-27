<?php

namespace app\controllers;

use Yii;

use app\models\AttachFiles;
use app\models\ResourceAnimal;
use app\models\ResourceAnimalSearch;
use app\models\ResearchArea;
use app\models\ResourceType;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use \dektrium\user\models\User;
/**
 * ResourceAnimalController implements the CRUD actions for ResourceAnimal model.
 */
class ResourceAnimalController extends Controller
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
     * Lists all ResourceAnimal models.
     * @return mixed
     */
	 public function actionIndexAdmin() // url : resource-plant/index-admin
    {
        $searchModel = new ResourceAnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index-admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 
	  /**
     * Displays a single ResourceAnimal model.
     * @param string $id
     * @return mixed
     */
	 public function actionViewAdmin($id)
    {
        $model = $this->findAnimal($id);
        $created_by = $this->findUser($model->created_by);
        $updated_by = $this->findUser($model->updated_by);
        
        return $this->render('view-admin', [
            'model' => $this->findAnimal($id),
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }
	 
/**
     * Creates a new ResourceAnimal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $animal = new ResourceAnimal();
        $type   = new ResourceType();
        $area   = new ResearchArea();

        if ($animal->load(Yii::$app->request->post()) && $animal->save(false)) {
            //print_r($_POST);
            $animal->zone_id = $_POST['ResearchArea']['name'];
            $animal->type_id = $_POST['ResourceType']['name'];
            $animal->common_name   = $_POST['ResourceAnimal']['common_name'];
            $animal->location_name = $_POST['ResourceAnimal']['location_name'];
            $animal->science_name = $_POST['ResourceAnimal']['science_name'];
            $animal->family_name = $_POST['ResourceAnimal']['family_name'];
            $animal->benefit = $_POST['ResourceAnimal']['benefit'];
            $animal->save();

            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $animal->id]);
        } else {
            return $this->render('create', [
                'animal' => $animal,
                'type'   => $type,
                'area'   => $area,
            ]);
        }
    }

    /**
     * Updates an existing ResourceAnimal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $animal = $this->findAnimal($id);

        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $animal]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }  

        $type = $this->findType($animal->type_id);
        $area = $this->findArea($animal->zone_id ); 

        if ($animal->load(Yii::$app->request->post()) && $animal->save(false)) {
            //print_r($_POST);
            $animal->zone_id = $_POST['ResearchArea']['name'];
            $animal->type_id = $_POST['ResourceType']['name'];
            $animal->common_name   = $_POST['ResourceAnimal']['common_name'];
            $animal->location_name = $_POST['ResourceAnimal']['location_name'];
            $animal->science_name = $_POST['ResourceAnimal']['science_name'];
            $animal->family_name = $_POST['ResourceAnimal']['family_name'];
            $animal->benefit = $_POST['ResourceAnimal']['benefit'];
            $animal->save();

            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $animal->id]);
        } else {
            return $this->render('update', [
                'animal' => $animal,
                'type'   => $type,
                'area'   => $area,
            ]);
        }
    }	
	/**
     * Deletes an existing ResourceAnimal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findAnimal($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }  
        $model->delete();
        return $this->redirect(['index-admin']);
    }

	 
    public function actionIndex()
    {
		$this->layout ='frontend';
        $searchModel = new ResourceAnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
		$this->layout ='frontend';
        $model = $this->findAnimal($id);
		$attach_files = $this->findImage($id);
        $created_by = $this -> findUser($model->created_by);
        $updated_by = $this -> findUser($model->updated_by);
		
        return $this->render('view', [
            'model' => $this->findAnimal($id),
			'attach_files'=>$attach_files,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }

    

    /**
     * Finds the ResourceAnimal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResourceAnimal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAnimal($id)
    {
        if (($model = ResourceAnimal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findArea($id)
    {
        if (($model = ResearchArea::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, area does not exist.');
        }
    }

    protected function findType($id)
    {
        if (($model = ResourceType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, type does not exist.');
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
	
	protected function findImage($id)
    {
        if (($model = AttachFiles::find()->andWhere(['model'=>'app\models\ResourceAnimal'])
            ->andWhere(['itemId'=>$id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[attachFiles]The requested page does not exist.');
        }
    }
}
