<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="micro-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body
	
   
	
    <?= $form->field($micro, 'genus')->textInput () ?>

    <?= $form->field($micro, 'species')->textInput() ?>

    <?= $form->field($micro, 'gen_info')->textInput() ?>

    <?= $form->field($zone, 'zone_id')->textInput() ?>
	
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
