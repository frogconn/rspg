<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrology */

$this->title = $model->genus;
$this->params['breadcrumbs'][] = ['label' => 'ทรัยากรจุลินทรีย์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-micrology-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('ย้อนกลับ',[ 'resource-micrology/'], ['class' => 'btn bg-navy']) ?>

        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('สร้างข้อมูลเพิ่ม',[ 'resource-micrology/create'], ['class' => 'btn bg-green']) ?>
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
            'resourceType.name',
            'genus',
            'species',
            'information:ntext',
            //'zone_id',
            'researchArea.name',
            'benefit:ntext',
            //'image_id',
            //'type_id',
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
