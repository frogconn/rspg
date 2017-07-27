<?php

namespace app\controllers;

use Yii;
use app\models\AttachFiles;
use app\models\ResearchArea;
use app\models\ResourceMicrology;
use app\models\ResourceMicrologySearch;
use app\models\ResourceType;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

use \dektrium\user\models\User;
/**
 * ResourceMicrologyController implements the CRUD actions for ResourceMicrology model.
 */
class ResourceMicrologyController extends Controller
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
     * Lists all ResourceMicrology models.
     * @return mixed
     */

     public function actionIndexAdmin() // url : resource-plant/index-admin
    {
        $searchModel = new ResourceMicrologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index-admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	 
	 public function actionViewAdmin($id)
    {
        $model = $this->findMicro($id);
        $created_by = $this->findUser($model->created_by);
        $updated_by = $this->findUser($model->updated_by);
        
        return $this->render('view-admin', [
            'model' => $this->findMicro($id),
            'created_by' => $created_by,
            'updated_by' => $updated_by,
        ]);
    }

    public function actionIndex()
    {
       $this->layout ='frontend';
        $searchModel = new ResourceMicrologySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ResourceMicrology model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout ='frontend';
        $model = $this->findMicro($id);
        $attach_files = $this->findImage($id);
        $updated_by = $this->findUser($model->updated_by);
        
        return $this->render('view', [
            'attach_files'=>$attach_files,
            'model' => $this->findMicro($id),
            'updated_by' => $updated_by,
        ]);
    }

    /**
     * Creates a new ResourceMicrology model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $micro = new ResourceMicrology();
        $area = new ResearchArea();
        $type = new ResourceType();

        if ($micro->load(Yii::$app->request->post()) && $micro->save(false)) {
            //print_r($_POST);
            $micro->zone_id = $_POST['ResearchArea']['name'];
            $micro->type_id = $_POST['ResourceType']['name'];
            $micro->genus   = $_POST['ResourceMicrology']['genus'];
            $micro->species = $_POST['ResourceMicrology']['species'];
            $micro->benefit = $_POST['ResourceMicrology']['benefit'];
            $micro->save();

            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('create', [
                'micro' => $micro,
                'area' => $area,
                'type' => $type,
            ]);
        }
    }

    /**
     * Updates an existing ResourceMicrology model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $micro = $this->findMicro($id);
        $area = $this->findArea($micro->zone_id ); 
        $type = $this->findType($micro->type_id);


        if ($micro->load(Yii::$app->request->post()) && $micro->save(false)) {
            $micro->zone_id = $_POST['ResearchArea']['name'];
            $micro->type_id = $_POST['ResourceType']['name'];
            $micro->genus   = $_POST['ResourceMicrology']['genus'];
            $micro->species = $_POST['ResourceMicrology']['species'];
            $micro->benefit = $_POST['ResourceMicrology']['benefit'];
            $micro->save();

            Yii::$app->session->setFlash('success', 'บันทึกข้อมูลเรียบร้อย');
            return $this->redirect(['view', 'id' => $micro->id]);
        } else {
            return $this->render('update', [
                'micro' => $micro,
                'area'  => $area,
                'type'  => $type,
            ]);
        }
    }

    /**
     * Deletes an existing ResourceMicrology model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findMicro($id);
        $session = Yii::$app->session;
        if ($session['user_role'] == 'Researcher' && !(\Yii::$app->user->can('updateOwnPost', ['model' => $model]))) {
            throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
        }  
        $model->delete();

        return $this->redirect(['index-admin']);
    }

    /**
     * Finds the ResourceMicrology model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ResourceMicrology the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findMicro($id)
    {
        if (($model = ResourceMicrology::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, micrology does not exist.');
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
        if (($model = AttachFiles::find()->andWhere(['model'=>'app\models\ResourcePlant'])
            ->andWhere(['itemId'=>$id])->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('[attachFiles]The requested page does not exist.');
        }
    }
}
