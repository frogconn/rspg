<?php
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;

use yii\helpers\ArrayHelper;
use app\models\Researcher;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
        <?= Html::a('สร้าง', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
   

    <div class="box box-success">
            <!--div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div-->

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=> ['style'=>'width:50px;']],

            // 'id',
            //'personal_code',
            // 'is_foreigner',
             [
                 'attribute' => 'is_foreigner',
                 'value' =>'isForeigner',
                 'filter'=>Html::activeDropDownList($searchModel, 'is_foreigner',ArrayHelper::map(Researcher::find()->asArray()->all(), 'id','is_foreigner'),['class'=>'form-control','prompt' => 'เลือกชาวต่างชาติ']),
                 'label' => 'ชาวต่างชาติ'
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
                 'filter'=>Html::activeDropDownList($searchModel, 'gender',ArrayHelper::map(Researcher::find()->asArray()->all(), 'id','gender'),['class'=>'form-control','prompt' => 'เลือกเพศ']),
                 'label' => 'เพศ'
             ],
            //'email',
            //'telephone',
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
