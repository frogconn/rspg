<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\ProjectType;
use app\models\ProjectGarjan;
use app\models\Researcher;

use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectGarjanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'พืชอนุรักษ์ยางนา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-garjan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้าง ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!--<div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            //'id',
			[
            'attribute' => 'type_id',
				 'value' => 'projectType.type',
                 'filter'=>Html::activeDropDownList($searchModel, 'type_id',ArrayHelper::map(ProjectType::find()->Where (['topic' => 'ยางนา'])->all(), 'id','type'),['class'=>'form-control','prompt' => 'เลือกหมวดหมู่']),
				 'label' => 'หมวดหมู่'
			],
			
			
            'year',
			'name',
			[
			'label' => 'หัวหน้าโครงการ',
			'attribute' => 'fullname_th',
			'value' => 'researcher.fullname_th',
			],
			
			
			/*[
                 'attribute' => 'personal_code',
                 'label' => 'หัวหน้าโครงการ',
                 'value' => 'researcher.fullname_th',
                 'filter'=>Html::activeDropDownList($searchModel, 'personal_code',ArrayHelper::map(Researcher::find()->asArray()->all(), 'personal_code','fullname_th'),['class'=>'form-control','prompt' => 'เลือกหัวหน้าโครงการ'])
            ],*/
            //'faculty_id',
            // 'budget',
            // 'type_id',
            // 'summary:ntext',
            // 'start',
            // 'stop',
            // 'created_by',
            // 'created_date',
            // 'update_by',
            // 'update_date',

              [
                'class' => 'app\widgets\ActionColumn',
                'options' => ['style' => 'width:100px;text-align:center;'],
              ],
        ],
    ]); ?>

				</div>
		</div>
</div>