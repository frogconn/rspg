<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use app\models\Zone;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($animal, 'com_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'loc_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'sc_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'fam_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($animal, 'gen_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($zone, 'zone_name')->dropdownList(ArrayHelper::map(
        Zone::find()->all(), 'zone_id', 'zone_name'), [
                'id'=>'ddl-zone',
                'prompt'=>'เลือกพื้นที่วิจัย'
            ]); 
    ?>

    <?= $form->field($animal, 'banefit')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'img_code')->textInput() ?>

    <?php //$form->field($model, 'type_id')->textInput() ?>

    <?php //$form->field($model, 'update_date')->textInput() ?>

    <?php //$form->field($model, 'created_by')->textInput() ?>

    <?php //$form->field($model, 'created_date')->textInput() ?>

    <?php //$form->field($model, 'update_by')->textInput() ?>

    <div class="box-footer">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
	               <?= Html::submitButton($animal->isNewRecord ? 'Create' : 'Update', ['class' => $animal->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                 &nbsp;
                 <?= Html::a('Cancle',[ 'researcher/'], ['class' => 'btn btn-default']) ?>

                </div>
            </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
