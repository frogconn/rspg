<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectEcologySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลด้านนิเวศวิทยาและชุมชน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-ecology-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box box-success">
            <!-- class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

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
            [
                 'attribute' => 'type',
                 'label' => 'หมวดหมู่',
                 'value' => 'projectType.type'
            ],
            'year',
            'name',
            [
                 'attribute' => 'fullname_th',
                 'label' => 'หัวหน้าโครงการ',
                 'value' => 'researcher.fullname_th'
            ],
            'faculty_id',
            // 'budget',
            // 'summary:ntext',
            // 'type_id',
            // 'created_by',
            // 'created_date',
            // 'updated_by',
            // 'updated_date',

              [
                'class' => 'app\widgets\ActionColumn',
                'options' => ['style' => 'width:100px;text-align:center;'],
              ],
        ],
    ]); ?>
<?php yii\widgets\Pjax::end(); ?></div>
</div>

</div>
