<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Researcher */

$this->title = $model->title.$model->firstname_th." ".$model->lastname_th;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลนักวิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('ย้อนกลับ',[ 'researcher/'], ['class' => 'btn bg-navy']) ?>

        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('สร้างข้อมูลเพิ่ม',[ 'researcher/create'], ['class' => 'btn bg-green']) ?>
    </p>

      <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'personal_code',
            'isForeigner',
            [
                'format'=>'raw',
                'attribute'=>'ชื่อสถาบัน',
                'value'=>$instit->name,
            ],
            [
                'format'=>'raw',
                'attribute'=>'ชื่อคณะ',
                'value'=>$faculty->name,
            ],
            'title',
            'firstname_th',
            'lastname_th',
            'firstname_en',
            'lastname_en',
            'fullname_th',
            'fullname_en',
            'gGender',
            'email',
            'telephone',
            //[
            //'format'=>'raw',
            //'attribute'=>'evidence_file',
            //'value'=>Html::img($attach_file->photoViewer,['class'=>'img-thumbnail','style'=>'width:200px;'])
            //],
            'created_date',
            [
                'format'=>'raw',
                'attribute'=>'สร้างโดย',
                'value'=>$created_by->username,
            ],
            'updated_date',
            [
                'format'=>'raw',
                'attribute'=>'แก้ไขล่าสุดโดย',
                'value'=>$updated_by->username,
            ],
        ],
    ]) ?>
</div>
</div>
</div>
