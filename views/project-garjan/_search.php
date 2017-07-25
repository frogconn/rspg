<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectGarjanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-garjan-search">

    

    <?= $form->field($searchModel, 'id') ?>

    <?= $form->field($searchModel, 'year') ?>

    <?= $form->field($searchModel, 'name') ?>

    <?= $form->field($searchModel, 'fullname_th') ?>

    <?php//= $form->field($model, 'faculty_id') ?>

    <?php // echo $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'stop') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'update_by') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
