<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearchAreaInformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลพื้นที่วิจัย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-area-information-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Research Area Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            //'id',
            'province_id',
            'amphur_id',
            'district_id',
            'region_id',
            // 'image_id',
            // 'information:ntext',
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
