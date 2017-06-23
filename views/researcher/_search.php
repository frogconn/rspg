<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResearcherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="researcher-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'foreigner') ?>

    <?= $form->field($model, 'institution_id') ?>

    <?= $form->field($model, 'faculty_id') ?>

    <?= $form->field($model, 'pers_id') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'fristname_th') ?>

    <?php // echo $form->field($model, 'lastname_th') ?>

    <?php // echo $form->field($model, 'fristname_en') ?>

    <?php // echo $form->field($model, 'lastname_en') ?>

    <?php // echo $form->field($model, 'fullname_th') ?>

    <?php // echo $form->field($model, 'fullname_en') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telephone') ?>

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
