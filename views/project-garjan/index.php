<?php

use yii\helpers\Html;
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
        <?= Html::a('Create ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!--<div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

            <div class="box-body">


<?php Pjax::begin(); ?>    <?= GridView::widget([
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
<?php Pjax::end(); ?></div>
</div>

</div>
