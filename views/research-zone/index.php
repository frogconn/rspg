<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearchZoneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Research Zones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="research-zone-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Research Zone', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 
    <div class="box box-success">
        <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        </div>
    <div class="box-body">

    <?= //print_r($searchModel);
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'zone_id',
            //'p_id',
            //'a_id',
            //'d_id',
            'd_name',
            'a_name',
            'p_name', 
            // 'geo_id',
            // 'img_id',
            // 'gen_info',
            // 'update_date',
            // 'created_by',
            // 'created_date',
            // 'update_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
</div>
