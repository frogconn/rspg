<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'animal_id')->textInput() ?>

    <?= $form->field($model, 'com_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loc_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sc_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fam_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gen_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zone_id')->textInput() ?>

    <?= $form->field($model, 'banefit')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'img_code')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
