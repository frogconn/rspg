<?php

/**
 * @author Pai Kittiphan <ksorn@kku.ac.th>
 * @since 2.0
 */

namespace app\widgets;
use Yii;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use app\assets\AttachFilesAsset;

class Upload extends \yii\base\Widget {

  public $model;
  public $required = true;

  public function init() {
    AttachFilesAsset::register($this->getView());
    parent::init();
  }
  public function run() {

      $required = $this->required == true ? 'required' : '';

      echo '<div class="form-group upload-files '.$required.'">
              <div class="col-md-2 text-right">
                <label class="control-label" for="testfile-name">ไฟล์แนบ/รูปภาพ</label>
                <div class="clearfix"></div>
                <span class="text-muted"><small>(นามสกุลไฟล์ pdf,png,jpg)</small></span>
              </div>

              <div class="col-md-9">
                <button id="photo-upload" class="btn btn-primary" type="button">
                  <i class="glyphicon glyphicon-folder-open"></i>&nbsp;&nbsp;เลือกไฟล์..
                </button>';

      echo '<div class="upload-progress"></div>';

       echo Html::fileInput('files', null, [
           'id' => 'photo-file',
           'class' => 'hidden',
           'multiple' => 'multiple',
           'urlto' => Url::to(['/upload/upload-file','itemId'=>$this->model->isNewRecord ? 0 : $this->model->id,'module'=>$this->model->className(),'csrf'=>Yii::$app->request->csrfToken])
       ]);

       echo '<div class="clearfix"></div>

               <div class="alert alert-danger files-error" style="display:none;margin-top:10px;">
                 <ul></ul>
               </div>

               <div id="files-list">
                 '.$this->model->getFiles().'
               </div>

           </div>

          </div>

           ';

  }

}
