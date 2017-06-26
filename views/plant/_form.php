<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;




/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-form">

	<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>
	
    <div class="box-body>	


	

    <?= $form->field($model, 'plant_id')->textInput() ?>

    <?= $form->field($model, 'com_name')->textInput() ?>

    <?= $form->field($model, 'loc_name')->textInput() ?>

    <?= $form->field($model, 'sc_name')->textInput() ?>

    <?= $form->field($model, 'fam_name')->textInput() ?>

    <?= $form->field($model, 'gen_info')->textarea() ?>

    <?= $form->field($model, 'zone_id')->textInput() ?>

    <?= $form->field($model, 'banefit')->textarea() ?>



	<div class="box-footer">
    <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancle',[ 'test/'], ['class' => 'btn btn-default'] ) ?>
	</div>
</div>
</div>
    <?php ActiveForm::end(); ?>


</div>
