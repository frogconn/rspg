<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformation */

$this->title = $area_name->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลพื้นที่วิจัย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-area-information-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('ย้อนกลับ',[ 'research-area-information/'], ['class' => 'btn bg-navy']) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],

        ]) ?>
        <?= Html::a('สร้างข้อมูลเพิ่ม',[ 'research-area-information/create'], ['class' => 'btn bg-green']) ?>


    </p>

      <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
            'format'=>'raw',
            'attribute'=>'ชื่อพื้นที่วิจัย',
            'value'=>$area_name->name,
            ],
            'addressProvince.name',
            'addressAmphur.name',
            'addressDistrict.name',
            'addressRegion.name',
           //* 'image_id',
            'information',
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


 

