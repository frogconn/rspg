<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearcherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Micro';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="micro-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Micro', ['create'], ['class' => 'btn btn-success']) ?>
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
				
			//'id',
            'genus',
            //'mic_id',
            'species',
            //'gen_info:ntext',
            'zone_id',
            //'banefit:ntext',
            //'img_code',
            //'type_id',
            //'update_date',
            //'created_by',
            //'created_date',
            //'update_by',

              [
                'class' => 'app\widgets\ActionColumn',
                'options' => ['style' => 'width:100px;text-align:center;'],
              ],
			],
		]); 
	?>
</div>
</div>

</div>
		
			

