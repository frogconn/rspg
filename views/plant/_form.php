<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plant-form">

	<?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>

    <div class="box-body>




    <?= $form->field($plant, 'plant_id')->textInput() ?>

    <?= $form->field($plant, 'com_name')->textInput() ?>

    <?= $form->field($plant, 'loc_name')->textInput() ?>

    <?= $form->field($plant, 'sc_name')->textInput() ?>

    <?= $form->field($plant, 'fam_name')->textInput() ?>

    <?= $form->field($plant, 'gen_info')->textarea() ?>

    <?= $form->field($zone, 'zone_id')->textInput() ?>

    <?= $form->field($plant, 'banefit')->textarea() ?>



	<div class="box-footer">
    <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
        <?= Html::submitButton($plant->isNewRecord ? 'Create' : 'Update', ['class' => $plant->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?= Html::a('Cancle',[ 'test/'], ['class' => 'btn btn-default'] ) ?>
	</div>
</div>
</div>
    <?php ActiveForm::end(); ?>


</div>
