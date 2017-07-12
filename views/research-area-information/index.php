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

    <p>
        <?= Html::a('สร้าง', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            

            <div class="box-body">


<?php yii\widgets\Pjax::begin(['id' => 'grid-user-pjax','timeout'=>5000]); ?>
<?php echo $this->render('_search', ['model' => $searchModel]); ?>
<br>
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            //'id',
            //'province_id',
            [
                 'attribute' => 'area_name',
                 'label' => 'ชื่อพื้นที่วิจัย',
                 'value' => 'researchArea.name'
            ],
            [
                 'attribute' => 'district_name',
                 'label' => 'ตำบล',
                 'value' => 'addressDistrict.name'
            ],
            [
                 'attribute' => 'amphur_name',
                 'label' => 'อำเภอ',
                 'value' => 'addressAmphur.name'
            ],
            [
                 'attribute' => 'province_name',
                 'label' => 'จังหวัด',
                 'value' => 'addressProvince.name'
            ],
            [
                 'attribute' => 'region_name',
                 'label' => 'ภูมิภาค',
                 'value' => 'addressRegion.name'
            ],
            //'amphur_id',
           // 'district_id',
            //'region_id',
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
<?php yii\widgets\Pjax::end(); ?></div>
</div>

</div>
