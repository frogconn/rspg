<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use app\models\ResourceType;
use app\models\ResearchArea;

use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourceAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลทรัพยากรสัตว์และแมลง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-animal-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">


 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        /*'tableOptions' => [
            'class' => 'table table-bordered table-striped table-hover',
            ],*/
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],
            
            //'id',
            [
                 'attribute' => 'type_id',
                 'value' => 'resourceType.name',
                 'filter'=>Html::activeDropDownList($searchModel, 'type_id',ArrayHelper::map(ResourceType::find()->where (['class' => 'สัตว์และแมลง'])->all(), 'id','name'),['class'=>'form-control','prompt' => 'เลือกประเภท']),
                 'label' => 'ประเภท',
            ],
            'common_name',
            'location_name',
            //'science_name',
            //'family_name',
            [  
                'attribute' => 'zone_id',
                 'value' => 'researchArea.name',
                 'filter'=>Html::activeDropDownList($searchModel, 'zone_id',ArrayHelper::map(ResearchArea::find()->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'เลือกพื้นที่วิจัย']),
                 'label' => 'ข้อมูลพื้นที่วิจัย'
            ], 
            // 'information:ntext',
            //'zone_id',
            // 'benefit:ntext',
            // 'image_id',
            // 'type_id',
            // 'created_date',
            // 'created_by',
            // 'updated_date',
            // 'updated_by',

              [
                'class' => 'app\widgets\ActionColumn',
                'options' => ['style' => 'width:100px;text-align:center;'],
              ],
        ],
    ]); ?>

</div>

</div>
