<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use app\Models\Type;
use app\Models\Zone;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="micro-form">

    <?php $form = ActiveForm::begin(); ?>

 
	<?= $form->field($type, 'type_name')->dropdownList(ArrayHelper::map(
        Type::find()->where(['type_class' => 'จุลินทรีย์'])->all(), 'type_id', 'type_name'), [
                'id'=>'ddl-type',
                'prompt'=>'เลือกประเภทของจุลินทรีย์'
            ]); 
    ?>
	
    <?= $form->field($micro, 'genus')->textInput () ?>

    <?= $form->field($micro, 'species')->textInput() ?>

    <?= $form->field($micro, 'gen_info')->textInput() ?>

     <?= $form->field($zone, 'zone_name')->dropdownList(ArrayHelper::map(
        Zone::find()->all(), 'zone_id', 'zone_name'), [
                'id'=>'ddl-zone',
                'options' => [
                    $zone->zone_id => ['Selected'=>'selected']],
                'prompt'=>'เลือกพื้นที่วิจัย'
            ]); 
    ?>
    <?= $form->field($micro, 'banefit')->textInput() ?>
	
	
</div>

	<div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($micro->isNewRecord ? 'Create' : 'Update', ['class' => $micro->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'test/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
