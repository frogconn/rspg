<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearchZoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Research Zones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-zone-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Research Zone', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>

            <div class="box-body">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            'id',
            'zone_id',
            'zone_name',
            'province_id',
            'amphur_id',
            // 'district_id',
            // 'region_id',
            // 'img_id',
            // 'information',
            // 'update_date',
            // 'created_by',
            // 'created_date',
            // 'update_by',

              [
                'class' => 'app\widgets\ActionColumn',
                'options' => ['style' => 'width:100px;text-align:center;'],
              ],
        ],
    ]); ?>
</div>
</div>

</div>
