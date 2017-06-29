<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResourceAnimalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-animal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'common_name') ?>

    <?= $form->field($model, 'location_name') ?>

    <?= $form->field($model, 'science_name') ?>

    <?= $form->field($model, 'family_name') ?>

    <?php // echo $form->field($model, 'information') ?>

    <?php // echo $form->field($model, 'zone_id') ?>

    <?php // echo $form->field($model, 'benefit') ?>

    <?php // echo $form->field($model, 'image_id') ?>

    <?php // echo $form->field($model, 'type_id') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
