<?php

namespace app\controllers;

use Yii;
use app\models\Animal;
use app\models\AnimalSearch;
use app\models\Zone;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;

/**
 * AnimalController implements the CRUD actions for Animal model.
 */
class AnimalController extends Controller
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
     * Lists all Animal models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnimalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Animal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findAnimal($id),
        ]);
    }

    /**
     * Creates a new Animal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $animal = new Animal(); 
        $zone = new Zone();

        if ($animal->load(Yii::$app->request->post()) && $animal->save(false)) {
            $animal->zone_id = $_POST['Zone']['zone_name'];
            $animal->save();
            return $this->redirect(['animal/index']);
            //return $this->redirect(['view', 'id' => $animal->id]);
        } else {
            return $this->render('create', [
                'animal' => $animal,
                'zone' => $zone
            ]);
        }
    }

    /**
     * Updates an existing Animal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $animal = $this->findAnimal($id);
        $zone = $this->findZone($animal->zone_id);

        if ($animal->load(Yii::$app->request->post()) && $animal->save()) {
            return $this->redirect(['view', 'id' => $animal->id]);
        } else {
            return $this->render('update', [
                'animal' => $animal,
                'zone' => $zone
            ]);
        }
    }

    /**
     * Deletes an existing Animal model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findAnimal($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Animal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Animal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findAnimal($id)
    {
        if (($model = Animal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, animal does not exist.');
        }
    }

    protected function findZone($id){
        if (($model = Zone::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page, Zone does not exist.');
        }
    }
}
