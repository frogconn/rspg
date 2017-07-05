<?php

namespace app\controllers;

use yii\imagine\Image;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use app\models\AttachFiles;
use yii\web\Response;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * NewsController implements the CRUD actions for News model.
 */
class UploadController extends Controller
{

    public function actionUploadFile($module,$itemId,$csrf) {
      $success = null;
      $model = new AttachFiles;
      $filename = UploadedFile::getInstance($model, 'name');
      $directory = Yii::getAlias('@app' . '/web/uploads/files/');
      if (!is_dir($directory)) {
          mkdir($directory);
      }
      if ($filename) {
          $uid = uniqid();
          $file_name = $uid . '_' . $filename->name;
          $file_path = $directory . $file_name;
          $filename->saveAs($file_path);

          $model->name = $file_name;
          $model->model = $module;
          $model->itemId = $itemId;
          $model->hash = $csrf;
          $model->type = $filename->extension;
          $model->size = $filename->size;
          $model->mime = $filename->type;
          $model->save();

          $success = [
              'result' => 'success',
              'message' => 'Uploaded.',
              'files_list' => $this->getFiles($itemId,$model,$module)
          ];
      }

      return Json::encode($success);

    }

    public function actionDeleteFile(){
      $success = null;
      if (Yii::$app->request->isAjax) {
        $id = Yii::$app->request->post('id');
        $model = AttachFiles::findOne($id);
        $model->delete();
        $directory = Yii::getAlias('@app' . '/web/uploads/files/');
        unlink($directory.$model->name);
        $success = [
            'result' => 'success',
            'message' => 'Deleted.',
            'files_list' => $this->getFiles($model->itemId,$model,$model->model)
        ];
      }
      return Json::encode($success);
    }

    public function getFiles($itemId,$model,$module){
      if($itemId == 0){
        $module = new $module;
        $provider = new ArrayDataProvider([
           'allModels' => AttachFiles::find()->where(['hash' => $model->hash])->orderBy('id DESC')->all(),
        ]);
        if($provider->getCount() > 0){
          return $module->getListFiles($provider);
        }else{
          return '';
        }
      }else{
        $module = $module::findOne($itemId);
        return $module->getFiles();
      }

    }



}
