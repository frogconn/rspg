<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectGarjanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Garjans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-garjan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project Garjan', ['create'], ['class' => 'btn btn-success']) ?>
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
            'year',
            'name',
            'personal_code',
            'faculty_id',
            // 'budget',
            // 'project_type_id',
            // 'summary:ntext',
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
