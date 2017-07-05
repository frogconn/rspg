<?php

namespace app\components;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;
use app\models\AttachFiles;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

class UploadBehavior extends Behavior
{

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'saveUploads',
        ];
    }

    public function saveUploads($event)
    {
        $request = Yii::$app->request;
        if($request->post('_csrf')){
          $_csrf = $request->post('_csrf');
          AttachFiles::updateAll(['itemId' => $this->owner->id], 'hash = "'.$_csrf.'"');
        }
    }


    public function getFiles()
    {
        $provider = new ArrayDataProvider([
           'allModels' => AttachFiles::find()->where(['itemId' => $this->owner->id,'model' => $this->owner->className()])->orderBy('id DESC')->all(),
        ]);

        if($provider->getCount() > 0){
          return $this->getListFiles($provider);
        }else{
          return '';
        }
    }

    public function getFilesView()
    {
        $provider = new ArrayDataProvider([
           'allModels' => AttachFiles::find()->where(['itemId' => $this->owner->id,'model' => $this->owner->className()])->orderBy('id DESC')->all(),
        ]);

        if($provider->getCount() > 0){
          return $this->getListFilesView($provider);
        }else{
          return '';
        }
    }


    public function getListFiles($provider){
      return GridView::widget([
          'dataProvider' => $provider,
          'layout' => "{items}",
          'tableOptions' => ['class' => 'table table-condensed'],
          'columns' => [
               [
                 'header' => 'ชื่อไฟล์',
                 'value' => function ($model) {
                   $icon['pdf'] = 'file-pdf-o';
                   $icon['jpg'] = 'file-image-o';
                   $icon['jpeg'] = 'file-image-o';
                   $icon['png'] = 'file-image-o';
                   $icon['gif'] = 'file-image-o';
                   $icon['doc'] = 'file-word-o';
                   $icon['docx'] = 'file-word-o';
                   $icon['xls'] = 'file-excel-o';
                   $icon['xlsx'] = 'file-excel-o';
                   $icon['ppt'] = 'file-powerpoint-o';
                   $icon['pptx'] = 'file-powerpoint-o';

                   if (!isset($icon[strtolower($model->type)])){
                     $icon[strtolower($model->type)] = 'file-text-o';
                   }
                   $link  = Html::a('<i class="fa fa-'.$icon[strtolower($model->type)].'"></i> '.$model->name, Url::to(['/uploads/files/'.$model->name]), [
                           'target'=>'_blank',
                           'style' =>'font-weight:bold;'
                         ]);

                   return $link;
                 },
                 'format' => 'raw',
                 'headerOptions' => ['class' => 'text-center'],

               ],
               [
                 'header' => 'ขนาดไฟล์',
                 'value' => function ($model) {
                   return $this->getSizeFile($model->size);
                 },
                 'format' => 'raw',
                 'headerOptions' => ['style' => 'width:140px;','class' => 'text-center'],
                 'contentOptions' => ['class' => 'text-center'],
               ],
               [
                 'header' => 'จัดการ',
                 'value' => function ($model) {

                   $delete = Html::a('<i class="fa fa-trash"></i>', 'javascript::void(0)', [
                           'title' => Yii::t('yii', 'Delete'),
                           'aria-label' => Yii::t('yii', 'Delete'),
                           'data-pjax' => '0',
                           'class' => 'btn btn-danger btn-xs btn-delete-file',
                           'data-toggle' => 'tooltip',
                           'data-id' => $model->id,
                           'data-url' => Url::to(['/upload/delete-file']),
                         ]);

                  return $delete;

                 },
                 'format' => 'raw',
                 'headerOptions' => ['style' => 'width:50px;','class' => 'text-center'],
                 'contentOptions' => ['class' => 'text-center'],
              ],
          ]
      ]);
    }

    public function getListFilesView($provider){
      return GridView::widget([
          'dataProvider' => $provider,
          'layout' => "{items}",
          'tableOptions' => ['class' => 'table table-condensed'],
          'columns' => [
               [
                 'header' => 'ชื่อไฟล์',
                 'value' => function ($model) {
                   $icon['pdf'] = 'file-pdf-o';
                   $icon['jpg'] = 'file-image-o';
                   $icon['jpeg'] = 'file-image-o';
                   $icon['png'] = 'file-image-o';
                   $icon['gif'] = 'file-image-o';
                   $icon['doc'] = 'file-word-o';
                   $icon['docx'] = 'file-word-o';
                   $icon['xls'] = 'file-excel-o';
                   $icon['xlsx'] = 'file-excel-o';
                   $icon['ppt'] = 'file-powerpoint-o';
                   $icon['pptx'] = 'file-powerpoint-o';

                   if (!isset($icon[strtolower($model->type)])){
                     $icon[strtolower($model->type)] = 'file-text-o';
                   }
                   $link  = Html::a('<i class="fa fa-'.$icon[strtolower($model->type)].'"></i> '.$model->name, Url::to(['/uploads/files/'.$model->name]), [
                           'target'=>'_blank',
                           'style' =>'font-weight:bold;'
                         ]);

                   $resp = '<div class="row">';
                   $resp .= '<div class="col-md-9" style="overflow-wrap: break-word;">'.$link.'</div>';
                   $resp .= '<div class="col-md-3 text-right">'.$this->getSizeFile($model->size).'</div>';
                   $resp .= '</div>';

                   return $resp;

                 },
                 'format' => 'raw',
                 'headerOptions' => ['class' => 'text-center'],

               ],

          ]
      ]);
    }

    public function getSizeFile($bytes){
      if ($bytes < 1000 * 1024){
        return number_format($bytes / 1024, 2) . " KB";
      }elseif ($bytes < 1000 * 1048576){
        return number_format($bytes / 1048576, 2) . " MB";
      }elseif ($bytes < 1000 * 1073741824){
        return number_format($bytes / 1073741824, 2) . " GB";
      }else{
         return number_format($bytes / 1099511627776, 2) . " TB";
      }

    }



}
