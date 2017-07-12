<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">


<?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]); ?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<br>
    <?= GridView::widget([
        'id' => 'grid-user',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-striped table-hover',
            ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            [

                 'attribute' => 'type_name',
                 'label' => 'ประเภท',
                 'value' => 'resourceType.name'
 
            ],
            //'id',
            'genus',
            'species',
            //'information:ntext',
            //'zone_id',
            [

                 'attribute' => 'zone_name',
                 'label' => 'ข้อมูลพื้นที่วิจัย',
                 'value' => 'researchArea.name'
 
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
<?php yii\widgets\Pjax::end(); ?></div>
</div>

</div>
