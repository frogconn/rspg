<?php
use yii\base\Controller;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectEcology */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'โครงการนิเวศวิทยาและชุมชน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-ecology-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('ย้อนกลับ',[ 'project-ecology/index-admin/'], ['class' => 'btn bg-navy']) ?>

        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('สร้างข้อมูลเพิ่ม',[ 'project-ecology/create'], ['class' => 'btn bg-green']) ?>
    </p>

      <div class="box box-success">
            <!-- class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'projectType.type',
            'year',
            'name',
            [
                'format'=>'raw',
                'attribute'=>'หัวหน้าโครงการ',
                'value'=>$researcher->fullname_th,
            ],
            [
                'label'=>'ผู้ร่วมโครงการ',
                'format'=>'raw',
                'value'=>Yii::$app->controller->renderPartial('_partitions', array('model'=>$model), true),
            ],
            'budget',
            'summary:ntext',
            'start',
            'stop',

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
