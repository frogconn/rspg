<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MicroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="micro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'genus') ?>

    <?= $form->field($model, 'mic_id') ?>

    <?= $form->field($model, 'species') ?>

    <?= $form->field($model, 'gen_info') ?>

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
