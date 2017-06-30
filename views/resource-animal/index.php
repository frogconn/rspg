<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourceAnimalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resource Animals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-animal-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Resource Animal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="box-body">


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],
            
            //'id',
            'common_name',
            'location_name',
            'science_name',
            'family_name',
            [  
                'attribute' => 'zone_name',  // !!! important to matches the name attribute
                'label'=>'ชื่อพื้นที่วิจัย',
                'value'=> 'researchArea.name', 
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
<?php Pjax::end(); ?></div>
</div>

</div>
