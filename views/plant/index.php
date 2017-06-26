<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearcherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plant';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Plant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>




    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
			'options'=> ['style'=>'width:50px;']],

            //'id',
             //'plant_id',
             'com_name',
             'loc_name',
             'sc_name',
             //'fam_name',
             //'gen_info',
            //'zone_id',
            // 'banefit',
            //'img_code',
            //'type_id',
            // 'update_date',
            // 'created_by',
            // 'created_date',
            // 'update_by',

              [
                'class' => 'app\widgets\ActionColumn',
                //'options' => ['style' => 'width:100px;text-align:center;'],
              ],
        ],
		
    ]);
	?>
</div>
</div>

</div>
