<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

use app\models\ResourceType;
use app\models\ResearchArea;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceMicrologySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-micrology-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        
    ]); ?>




    <div class="col-xs-5">
       <?= $form->field($model, 'searchAll') ?>
    </div>


    <div class="col-xs-3">
        <?= $form ->field($type_name, 'name')->dropdownList (ArrayHelper::map(
        ResourceType::find()->where (['class' => 'จุลินทรีย์'])->all(), 'id','name'),[
                'prompt'=>'เลือกประเภทจุลินทรีย์'
                 ]);
         ?>
    </div>

    <div class="col-xs-2">
         <?= $form ->field($zone_name,'name')->dropdownList (ArrayHelper::map(
        ResearchArea::find()->all(), 'id','name'),[
                'prompt'=>'เลือกพื้นที่วิจัย'
                 ]);
        ?>
    </div>
<div class="col-xs-2">
<br>
        <div class="form-group">
            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
            <!--?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?-->
            <?= Html::a('ยกเลิก', ['reset'], ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>