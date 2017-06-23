<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnimalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'animal_id') ?>

    <?= $form->field($model, 'com_name') ?>

    <?= $form->field($model, 'loc_name') ?>

    <?= $form->field($model, 'sc_name') ?>

    <?php // echo $form->field($model, 'fam_name') ?>

    <?php // echo $form->field($model, 'gen_info') ?>

    <?php // echo $form->field($model, 'zone_id') ?>

    <?php // echo $form->field($model, 'banefit') ?>

    <?php // echo $form->field($model, 'img_code') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
