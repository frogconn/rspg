<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;

use yii\widgets\Pjax;

use app\models\ResourceType;
use app\models\ResearchArea;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourceMicrologySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลทรัพยากรจุลินทรีย์';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-micrology-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้าง', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
        <!--div class="box-header with-border">
            <h3 class="box-title">ค้นหา</h3>
        </div-->
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel, 'type_name' => $type_name , 'zone_name' => $zone_name]); ?>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->




    <?= GridView::widget([
        'id' => 'grid-user',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,       
        'tableOptions' => [
            'class' => 'table table-bordered table-striped table-hover',
            ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            [

                 'attribute' => 'type_name',
                 'value' => 'resourceType.name',
                 'label' => 'ประเภท',
                 
 
            ],

            //'id',
            'genus',
            'species',
            //'information:ntext',
            //'zone_id',
            [

                 'attribute' => 'zone_name',
                 'value' => 'researchArea.name',
                 'label' => 'ข้อมูลพื้นที่วิจัย'
 
            ],
            
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

</div>
