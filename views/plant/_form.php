<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use app\models\Zone;
use app\models\Type;



/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-form">

	<?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($type, 'type_name')->dropdownList(ArrayHelper::map(
        Type::find()->where(['type_class' => 'พืช'])->all() , 'type_id', 'type_name'), [
                'id'=>'ddl-type',         
                'prompt'=>'เลือกประเภทของพืช'
            ]); 
    ?>
	

    <?= $form->field($model, 'plant_id')->textInput() ?>

    <?= $form->field($model, 'com_name')->textInput() ?>

    <?= $form->field($model, 'loc_name')->textInput() ?>

    <?= $form->field($model, 'sc_name')->textInput() ?>

    <?= $form->field($model, 'fam_name')->textInput() ?>

    <?= $form->field($model, 'gen_info')->textarea() ?>

    <?= $form->field($zone, 'zone_name')->dropdownList(ArrayHelper::map(
        Zone::find()->all(), 'zone_id', 'zone_name'), [
                'id'=>'ddl-zone',
                'prompt'=>'เลือกพื้นที่วิจัย'
            ]); 
		?>
    <?= $form->field($model, 'banefit')->textarea() ?>


   <div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>
    </div>

    <?php ActiveForm::end(); ?>
