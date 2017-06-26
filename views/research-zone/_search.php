<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ResearchZoneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="research-zone-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($zone, 'zone_name') ?>

    <?= $form->field($researchZone, 'p_name') ?>

    <?php //$form->field($model, 'p_id') ?>

    <?php //$form->field($model, 'a_id') ?>

    <?php //$form->field($model, 'd_id') ?>

    <?php //$form->field($model, 'geo_id') ?>

    <?php // echo $form->field($model, 'img_id') ?>

    <?php // echo $form->field($model, 'gen_info') ?>

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
