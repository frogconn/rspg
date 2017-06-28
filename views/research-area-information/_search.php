<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchAreaInformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-area-information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'province_id') ?>

    <?= $form->field($model, 'amphur_id') ?>

    <?= $form->field($model, 'district_id') ?>

    <?= $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'image_id') ?>

    <?php // echo $form->field($model, 'information') ?>

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
