<?php
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResearcherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลนักวิจัย';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="researcher-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-success">
        <!--div class="box-header with-border">
            <h3 class="box-title">ค้นหา</h3>
        </div-->
        <div class="box-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            // 'id',
            'personal_code',
            // 'is_foreigner',
             [
                 'attribute' => 'is_foreigner',
                 'value' =>'isForeigner',
             ],
            // 'title',
            // 'firstname_th',
            // 'lastname_th',
            // 'firstname_en',
            // 'lastname_en',
            'fullname_th',
            'fullname_en',
             [
                 'attribute' => 'gender',
                 'value' =>'gGender',
             ],
            'email',
            'telephone',
            // 'evidence_file',
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
</div>
</div>

</div>
